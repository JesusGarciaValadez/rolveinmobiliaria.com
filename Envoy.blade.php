@servers([
  'web' => ['user@192.168.1.1'],
  'localhost' => '127.0.0.1',
])

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
