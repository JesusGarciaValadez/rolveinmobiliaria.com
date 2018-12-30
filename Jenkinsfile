node {
  checkout scm
  sh "eval \$(aws ecr get-login --no-include-email)"
  shortCommit = sh(returnStdout: true, script: "git log -n 1 --pretty=format:'%h'").trim()
  lastCommitParent = sh(returnStdout: true, script: "git log -n 1 --pretty=format:'%h' | git show --no-patch --format=\"%p\" | awk '{print \$2}'").trim()
  isHotfix = !sh(returnStatus: true, script: "git log -n 1 --format=%B | grep -q '^/hotfix'")
  deployCommit = isHotfix ? shortCommit : (lastCommitParent ?: shortCommit)
}

pipeline {
  agent any

  stages {
    stage("build:prep") {
      when {
        expression {
          env.BRANCH_NAME != "production" || isHotfix
        }
      }

      steps {
        echo "Installing yarn dependencies"
        sh "docker-compose -f docker-compose.cli.yml run --rm --name dep-js-" + shortCommit + " yarn"
        echo "Building frontend assets - shared between nginx and php images"
        sh "docker-compose -f docker-compose.cli.yml run --rm --name frontend-assets-" + shortCommit + " yarn build"
      }
    }

    stage("build:prod") {
      when {
        expression {
          env.BRANCH_NAME != "production" || isHotfix
        }
      }

      steps {
        sh "IMAGE_TAG=" + shortCommit + " docker-compose build --pull --build-arg GITHUB_TOKEN"
      }
    }

    stage("test:prep") {
      when {
        expression {
          env.BRANCH_NAME != "production" || isHotfix
        }
      }

      steps {
        echo "Creating services so the network is not duplicated"
        sh "IMAGE_TAG=" + shortCommit + " docker-compose up --no-start"
        echo "Copying .env.dist to .env"
        sh "cp .env.dist .env"
      }
    }

    stage("test") {
      when {
        expression {
          env.BRANCH_NAME != "production" || isHotfix
        }
      }

      steps {
        parallel(
          "lint:frontend": {
          sh "docker-compose -f docker-compose.cli.yml run --rm --name lint-misc-" + shortCommit + " yarn lint:check"
        },
        "test:frontend": {
          sh "docker-compose -f docker-compose.cli.yml run --rm --name test-frontend-" + shortCommit + " yarn test"
        },
        "test:php": {
          sh "IMAGE_TAG=" + shortCommit + " docker-compose run --rm --name test-php-" + shortCommit + " php vendor/bin/phpunit"
        },
        "lint:php": {
          sh "IMAGE_TAG=" + shortCommit + " docker-compose run --rm --name lint-php-" + shortCommit + " php composer lint:check"
        },
        "security:check": {
          sh "IMAGE_TAG=" + shortCommit + " docker-compose run --rm --name security-check-" + shortCommit + " php vendor/bin/security-checker security:check"
        },
        "lint:yaml": {
          sh "IMAGE_TAG=" + shortCommit + " docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm -e STORE=mx --name lint-yaml-" + shortCommit + " php bin/console lint:yaml config"
          sh "IMAGE_TAG=" + shortCommit + " docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm -e STORE=mx --name lint-yaml-" + shortCommit + " php bin/console lint:yaml translations"
        },
        "lint:twig": {
          sh "IMAGE_TAG=" + shortCommit + " docker-compose -f docker-compose.yml -f docker-compose.ci.yml run --rm -e STORE=mx --name lint-twig-" + shortCommit + " php bin/console lint:twig templates"
        }
      )
      }
    }

    stage("deploy:latest") {
      when {
        expression {
          env.BRANCH_NAME == "master"
        }
      }

      steps {
        sh "docker tag 137361304112.dkr.ecr.us-east-1.amazonaws.com/shop-front-php:" + shortCommit + " 137361304112.dkr.ecr.us-east-1.amazonaws.com/shop-front-php:latest"
        sh "docker tag 137361304112.dkr.ecr.us-east-1.amazonaws.com/shop-front-nginx:" + shortCommit + " 137361304112.dkr.ecr.us-east-1.amazonaws.com/shop-front-nginx:latest"
        sh "docker-compose push"
        sh "IMAGE_TAG=" + shortCommit + " docker-compose push"
      }
    }

    stage("deploy:latest-b") {
      when {
        expression {
          env.BRANCH_NAME == "production-b"
        }
      }

      steps {
        sh "IMAGE_TAG=" + shortCommit + " docker-compose push"
      }
    }

    stage("deploy:development") {
      when {
        expression {
          (currentBuild.result == null || currentBuild.result == "SUCCESS") && env.BRANCH_NAME == "master"
        }
      }

      steps {
        sh "docker pull 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-rake:latest"
        sh "docker run --rm -e REVISION=" + shortCommit + " -v \${HOME}/.kube/config:/root/.kube/config -v \${PWD}:/application -e RELEASE_CONTROL_API_KEY 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-rake:latest deploy:development"
      }
    }

    stage("deploy:development-b") {
      when {
        expression {
          (currentBuild.result == null || currentBuild.result == "SUCCESS") && env.BRANCH_NAME == "production-b"
        }
      }

      steps {
        sh "docker pull 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-rake:latest"
        sh "docker run --rm -e REVISION=" + shortCommit + " -v \${HOME}/.kube/config:/root/.kube/config -v \${PWD}:/application -e RELEASE_CONTROL_API_KEY 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-rake:latest deploy:development_b"
      }
    }

    stage("deploy:staging") {
      when {
        expression {
          (currentBuild.result == null || currentBuild.result == "SUCCESS") && env.BRANCH_NAME == "production"
        }
      }

      steps {
        script {
          if (isHotfix) {
            sh "IMAGE_TAG=" + deployCommit + " docker-compose push"
          }
        }
        sh "docker pull 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-rake:latest"
        sh "docker run --rm -e REVISION=" + deployCommit + " -v \${HOME}/.kube/config:/root/.kube/config -v \${PWD}:/application -e RELEASE_CONTROL_API_KEY 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-rake:latest deploy:staging"
      }
    }

    stage("deploy:staging-b") {
      when {
        expression {
          (currentBuild.result == null || currentBuild.result == "SUCCESS") && env.BRANCH_NAME == "production-b"
        }
      }

      steps {
        script {
          if (isHotfix) {
            sh "IMAGE_TAG=" + deployCommit + " docker-compose push"
          }
        }
        sh "docker pull 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-rake:latest"
        sh "docker run --rm -e REVISION=" + shortCommit + " -v \${HOME}/.kube/config:/root/.kube/config -v \${PWD}:/application -e RELEASE_CONTROL_API_KEY 137361304112.dkr.ecr.us-east-1.amazonaws.com/docker-rake:latest deploy:staging_b"
      }
    }

    stage("deploy:deprecated") {
      when {
        expression {
          (currentBuild.result == null || currentBuild.result == "SUCCESS") && (env.BRANCH_NAME == "master" || env.BRANCH_NAME == "production")
        }
      }

      steps {
        sh "bundle install --path=vendor/bundle --with=deploy"
        deploy("master", "development01")
        deploy("production", "staging01")
      }
    }
  }

  post {
    cleanup {
      sh "IMAGE_TAG=" + shortCommit + " docker-compose -f docker-compose.yml -f docker-compose.ci.yml down --rmi all || true"
    }
  }
}
