server "smallhadroncollider.com", user: "mark", roles: %w{app}

set :branch, "master"
set :deploy_to, "/var/www/restful.training"

namespace :deploy do
    after :published, "laravel:migrate_db"
end
