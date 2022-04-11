# Set Alias
```sh
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

# Install Dependency
```sh
sail composer require laravel/sanctum
sail composer require laravellegends/pt-br-validator

```

# Running tests
```sh
sail test
sail test --group orders
```
# Migrate
```sh
sail artisan migrate
sail debug migrate
```

# Setting Storege Folders
```sh
cd storage
mkdir logs
mkdir framework
mkdir framework/cache && framework/cache/data
mkdir framework/sessions
mkdir framework/testing
mkdir framework/views
chgrp -R www-data ../storage
chown -R www-data ../storage
```
# Delete Volumes

```sh
sail down -v
sail up -d
sail artisan config:cache
sail artisan migrate
```

# Databese

```sh
sail artisan db:seed
sail artisan db:seed --class=UserSeeder
sail artisan migrate:fresh --seed
sail artisan db:seed --force
```

# Clean Cache
```sh
sail artisan config:clear
sail artisan config:cache
```

# Generate Key
```sh
sail artisan key:generate
```

