# Data Science Experience + Watson Machine Learning

## Índice

1. [Descripción](https://github.com/nachoad/dsxwml#Descripción)
2. [Archivos](https://github.com/nachoad/dsxwml#Archivos)


## Descripción

Este proyecto muestra una demo de página web que llama al Endpoint de Watson Machine Learning, pasándole unos parámetros y obteniendo un resultado al ejecutar un modelo predictivo.

## Archivos

Básicamente la web sólo necesita dos archivos: <code>index.php</code> y <code>result.php</code>

index.php: Envía las creenciales de autenticación a Watson Machine Learning y recoge el token. Muestra la página principal de la aplicación con un formulario que contiene los parámetros de entrada del modelo. Este formulario envía tanto el token como el resto de parámetros a result.php

result.php: recibe los parámetros de index.php, y los envía al Endpoint de Watson Machine Learning para obtener el resultado final que muestra por pantalla. En este caso el precio de la vivienda.
