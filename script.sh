#!/usr/bin/env bash
set -e

# --------------------------------------------------
# Script de instalación y configuración de Bagisto
# Tema personalizado NatFitness
# --------------------------------------------------

# 1. Clonar e instalar Bagisto
composer create-project bagisto/bagisto natfitness --prefer-dist
cd natfitness

# 2. Configurar .env (ajusta con tus credenciales)
cp .env.example .env

# Base de datos
sed -i '' 's/^DB_DATABASE=.*/DB_DATABASE=bd/' .env

# Usuario
sed -i '' 's/^DB_USERNAME=.*/DB_USERNAME=user/' .env

# Contraseña (escapando el $)
sed -i '' 's/^DB_PASSWORD=.*/DB_PASSWORD=enPs^9kS$XujthD' .env

# 3. Generar key, migraciones, seeders y symlink de storage
php artisan key:generate
php artisan migrate --seed
php artisan storage:link

# 4. Publicar assets del core y preparar Laravel Mix
php artisan vendor:publish --tag=public --force

npm install laravel-mix cross-env --save-dev

# Crear webpack.mix.js mínimo
cat > webpack.mix.js << 'EOL'
let mix = require('laravel-mix');

mix
  .setPublicPath('public/themes/shop/default')
  .js('resources/js/app.js', 'js')
  .sass('resources/sass/app.scss', 'css')
  .copyDirectory('vendor/webkul/ui/src/assets/images', 'public/themes/shop/default/images')
  .copyDirectory('vendor/webkul/ui/src/assets/fonts', 'public/themes/shop/default/fonts');

// Copiar tema NatFitness
mix.copyDirectory(
  'packages/Webkul/NatFitness/src/Resources/assets',
  'public/themes/shop/natfitness/assets'
);
EOL

npm run development

# 5. Crear estructura del tema NatFitness
mkdir -p packages/Webkul/NatFitness/src/Resources/views/shop/home
mkdir -p packages/Webkul/NatFitness/src/Resources/views/shop/layouts
mkdir -p packages/Webkul/NatFitness/src/Resources/assets/{css,js,images}

# 6. Registrar el tema en config/themes.php
php -r "
\$file = 'config/themes.php';
\$lines = file(\$file);
\$out = [];
foreach (\$lines as \$l) {
    \$out[] = \$l;
    if (trim(\$l) === \"'shop' => [\") {
        \$out[] = \"        'natfitness' => [\\n\";
        \$out[] = \"            'name'        => 'NatFitness',\\n\";
        \$out[] = \"            'assets_path' => 'packages/Webkul/NatFitness/src/Resources/assets',\\n\";
        \$out[] = \"            'views_path'  => 'packages/Webkul/NatFitness/src/Resources/views',\\n\";
        \$out[] = \"        ],\\n\";
    }
}
file_put_contents(\$file, implode('', \$out));
"

# 7. Copiar tus archivos del scraper
# Ejecuta este script desde la carpeta que contiene:
#   syf_landing.html, syf_navbar.html, carpeta assets/{css,js,images}
cp ../syf_landing.html packages/Webkul/NatFitness/src/Resources/views/shop/home/index.blade.php
cp ../syf_navbar.html  packages/Webkul/NatFitness/src/Resources/views/shop/layouts/navbar.blade.php
cp -R ../assets/css/*    packages/Webkul/NatFitness/src/Resources/assets/css/
cp -R ../assets/js/*     packages/Webkul/NatFitness/src/Resources/assets/js/
cp -R ../assets/images/* packages/Webkul/NatFitness/src/Resources/assets/images/

# 8. Limpiar cachés y finalizar
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan cache:clear
composer dump-autoload

echo "🏁 Instalación completada. Ahora ejecuta: cd natfitness && php artisan serve"
