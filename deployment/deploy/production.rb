server "smallhadroncollider.com", user: "mark", roles: %w{app}

set :branch, "master"
set :deploy_to, "/var/www/restful.training"

SSHKit.config.command_map[:composer] = "php #{shared_path.join("composer.phar")}"

namespace :deploy do
    after :published, "laravel:migrate_db"
end
