
FROM php:8.4-cli-bookworm

# Install system dependencies and PostgreSQL development libraries
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    curl \
    ca-certificates \
    libpq-dev \
    libzip-dev \
    zip \
    nodejs \
    npm \
    && docker-php-ext-install pdo_pgsql pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Set the working directory
WORKDIR /workspaces

# Confirm the PostgreSQL extensions are available
RUN php -m | grep -E '^(pdo_pgsql|pgsql)$'

