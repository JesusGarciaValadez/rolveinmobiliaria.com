@servers(['localhost' => '127.0.0.1'])

@setup
  $now = new DateTime();

  $environment = isset($env) ? $env : "testing";

  $branch = isset($branch) ? $branch : "develop";
@endsetup

@task('deploy_dev', ['on' => 'localhost', 'confirm' => true])
  git push origin develop
@endtask

@story('deploy', ['confirm' => true])
  git
  @if ($environment != 'production')
    composer_install
    composer_update
  @endif
@endstory

@task('git')
  @if ($branch)
    git checkout {{ $branch }};

    git pull origin {{ $branch }};

    git push origin {{ $branch }};

    @if ($branch == 'master')
      git push heroku {{ $branch }};

      git checkout develop;
    @endif
  @endif
@endtask

@task('composer_install')
  composer install;
@endtask

@task('composer_update')
  composer update;
@endtask

@task('seed', ['confirm' => true])
  php artisan migrate:refresh --seed;
@endtask
