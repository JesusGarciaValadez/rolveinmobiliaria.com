@servers(['localhost' => '127.0.0.1'])

@task('deploy_dev', ['on' => 'localhost', 'confirm' => true])
    git pull origin develop
@endtask

@setup
  $now = new DateTime();

  $environment = isset($env) ? $env : "testing";
@endsetup

@story('deploy')
  git
  composer
@endstory

@task('git')
  git pull origin master
@endtask

@task('composer')
  composer install
@endtask

@task('seed')
  php artisan migrate:refresh --seed
@endtask

@task('tinker')
  artisan tinker
@endtask
