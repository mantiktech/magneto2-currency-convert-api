# Mantik Currency Convert API


![Magento 2.4 Supported](https://img.shields.io/badge/magento-2.4.0%E2%80%932.4.7+-brightgreen.svg?logo=magento&longCache=true&style=flat-square)
[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg)](https://opensource.org/licenses/MIT)

Módulo de Magento 2 para actualizar los precios de un store view en pesos Argentinos y los productos en dólares estadounidenses mediante una API externa gratuita.

## Descripción
- Importación de tipo de cambio  de moneda.
- Configurable desde el panel de administración y utilizable en la funcionalidad estándar de Magento para actualizar tasas.
- Compatible con Magento `2.4.X` y PHP `8.1–8.4`.
- Podes usar el precio de dolar oficial, dola blue, o el q necesites.
- Podes agregar o quitarle un monto al precio q trae la api.

## Requisitos
- PHP `8.1`, `8.2`, `8.3` o `8.4`.
- Magento `2.4.X` (o compatible con el framework `^103.0`).
- Acceso a la API publica de conversión de moneda que utilice el módulo (no necesitas cuenta en ningun otro lado).

## Instalación
### Instalar en `app/code`
1. Copiar el módulo a `app/code/Mantik/CurrencyConvertapi`.
2. Ejecutar:
   - `bin/magento module:enable Mantik_CurrencyConvertapi`
   - `bin/magento setup:upgrade`
   - `bin/magento cache:flush`
3. (Producción) Compilar y desplegar si aplica:
   - `bin/magento setup:di:compile`
   - `bin/magento setup:static-content:deploy -f`

### Instalar vía Composer (repositorio privado)
1. Requerir el paquete:
   - `composer require mantik/module-currency-convertapi:*`
2. Ejecutar comandos de Magento:
   - `bin/magento module:enable Mantik_CurrencyConvertapi`
   - `bin/magento setup:upgrade`

## Configuración
- Ir a `Stores > Configuration > General > Currency Setup` y seleccionar la opcion `Mantik Currency Convert API` para importar tasas.
- Configurar parámetros de la API si el módulo los expone en `Stores > Configuration`.
-
## Uso
- Actualizar tasas desde el panel (`Stores > Currency Rates`) usando el proveedor del módulo.
- Programar actualización automática mediante cron de Magento si se requiere.

## Licencia
Este módulo se distribuye bajo licencia MIT. Copyright © Mantik.

## Soporte
Para soporte y mejoras, contactar al equipo de [Mantik](https://www.mantik.tech/).
