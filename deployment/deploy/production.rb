server "restful.training", user: "ubuntu", roles: %w{app}

set :branch, "main"
set :deploy_to, "/var/www/restful.training"
