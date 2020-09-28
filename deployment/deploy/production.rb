server "restful.training", user: "ubuntu", roles: %w{app}

set :branch, "production"
set :deploy_to, "/var/www/restful.training"
