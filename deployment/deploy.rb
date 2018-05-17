# config valid only for current version of Capistrano
set :application, "restful.training"
set :repo_url, "git@github.com:smallhadroncollider/restful-blog.git"

# Default value for :linked_files is []
set :linked_files, fetch(:linked_files, []).push(".env")

# Default value for linked_dirs is []
set :linked_dirs, fetch(:linked_dirs, []).push("storage")

namespace :deploy do
    after :updating, "laravel:create_paths"
    after :published, "laravel:optimize"

    task :php_reload do
        on roles(:app) do
            info "Restarting PHP-FPM"
            execute "sudo service php7.2-fpm reload"
        end
    end

    after :published, "php_reload"
end
