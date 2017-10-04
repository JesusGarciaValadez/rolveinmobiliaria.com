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
  @if ($environment == 'production')
    heroku_bash

    composer_install

    composer_update

    migrate

    seed

    heroku_exit
  @endif
@endstory

@task('git')
  @if ($branch)
    @if ($branch == 'master')
      echo 'Master';

      git pull;

      git push;

      git checkout {{ $branch }};

      git merge develop;

      git pull origin {{ $branch }};

      git push origin {{ $branch }};

      @if ($environment == 'production')
        git push heroku {{ $branch }};
      @endif

      git checkout develop;
    @else
      git checkout {{ $branch }};

      git pull origin {{ $branch }};

      git push origin {{ $branch }};
    @endif
  @endif
@endtask

@task('heroku_bash')
  heroku run bash;
@endtask

@task('heroku_exit')
  exit;
@endtask

@task('composer_install')
  composer install;
@endtask

@task('composer_update')
  composer update;
@endtask

@task('')

@task('migrate', ['confirm' => true])
  php artisan migrate:refresh;
@endtask

@task('seed', ['confirm' => true])
  php artisan db:seed;
@endtask
