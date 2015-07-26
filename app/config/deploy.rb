set :application,             "Test"
set :domain,                  "agriculturefamiliale.com"
set :user,                    "agricultr"

set :app_path,                "app"
set :web_path,                "web"

set :repository,              "git@github.com:LehouxHugo/atlas.git"
set :scm,                     :git

set :keep_releases,           3
set :use_sudo,                false

logger.level = Logger::MAX_LEVEL