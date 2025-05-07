# 🚀 W4-LaravelKit

**W4-LaravelKit** Paquete diseñado para automatizar la instalación y configuración de los paquetes más utilizados en el desarrollo de proyectos **Laravel SPA (Single Page Applications)**. 
Su objetivo es mejorar la **Reactividad**, el **Diseño de Interfaces**, la **Experiencia de Usuario (UX)**, la **Seguridad** y el **Desarrollo Modular** en Laravel.

## 📌 Características Principales

✅ Instalación automatizada de paquetes esenciales para aplicaciones Laravel SPA.  
✅ Optimizado para **Livewire 3** y **DaisyUI 5**, mejorando el diseño y la interactividad.  
✅ Soporte para **Múltiples Idiomas** con Laravel Lang.  
✅ Estructura modular con **Laravel Modules**.  
✅ Comando especial para usar **Livewire dentro de Laravel Modules**. 
✅ Generación de **Tablas Interactivas Avanzadas** con LivewirePowerGrid.  
✅ Complementado para **Flujos de Trabajo Integrales** con Laravel-WorkFlow.
✅ Sistema de **Roles y Permisos** con Spatie LaravelPermission. 
✅ Creacion de **Agentes de Inteligencia Artificial** para aplicaciones Laravel con Neuron-AI.  

## ⚡ Compatibilidad y Versiones

| Laravel |  W4-LaravelKit |
|---------|----------------|
| 12.0    |  ^1.0.0        |

## 🛠 Paquetes Instalados Automáticamente

Al instalar **W4-LaravelKit**, se configuran y optimizan los siguientes paquetes para el desarrollo de aplicaciones de forma inmediata:

|            Paquete               |                                              Descripción                                                     |
|----------------------------------|--------------------------------------------------------------------------------------------------------------|
| **Laravel Livewire**             | Proporciona interactividad en tiempo real para aplicaciones SPA. *(Incluye soporte para Livewire Volt)*.     |
| **DaisyUI**                      | MicroFramework basado en **Tailwind CSS**, mejorando el diseño de interfaces y UX.                           |
| **Laravel Lang**                 | Agrega soporte para múltiples idiomas *(por defecto, traduce de inglés a español)*.                          |
| **Laravel Modules**              | Facilita la **Creación y Gestión de Módulos** en proyectos Laravel.                                          |
| **W4-LivewireModules**           | Creacion y gestion **Componentes Livewire-v3** dentro de Modulos de Laravel-Modules.                         |
| **Livewire PowerGrid**           | Permite la creación de **tablas interactivas** con filtros, exportación y paginación.                        |
| **Laravel-WorkFlow**             | Motor de **Flujos de Trabajo** duraderos para aplicaciones Laravel con orquestadores PHP.                    |
| **LaravelPermission**            | Facilita la **Administracion de Roles y Permisos** de usuarios en aplicaciones Laravel.                      |
| **Neuron-AI**                    | MicroFramework para **Creacion de Agentes Inteligentes y RAG** desarrollo de aplicaciones Laravel.           |
| **Blade UI & Blade FontAwesome** | Añade compatibilidad con **Componentes UI** e iconos **FontAwesome** en Blade.                               |

Además, se incluyen **Componentes Blade y Livewirel** de forma opcional como complemento para el **Desarrollo de Interfaces y UX**.

## 📦 Versiones de los Paquetes Utilizados

| Paquete                | Versión |
|------------------------|---------|
| Laravel Livewire       | ^3      |
| DaisyUI                | ^5      |
| Laravel Lang           | ^5      |
| Laravel Modules        | ^12     |
| W4-LivewireModules     | ^1      |
| Livewire PowerGrid     | ^6      |
| Laravel WorkFlow       | ^1      |
| LaravelPermission      | ^6      |
| Neuron-AI              | ^1      |
| Blade UI               | ^0.7.0  |
| Blade FontAwesome      | ^2.0    |

## 🔧 Instalación

Para instalar **W4LaravelKit** en tu proyecto Laravel, ejecuta:

```sh
composer require w4/laravelkit
```
## Despues de la instalacion ejecute:

```sh
php artisan w4laravelkit:install
```

Opcional: Componentes diseñados para la interfaz de usuario
```sh
php artisan vendor:publish --tag=w4laravelkit-components
```
Practicamente eso es todo, su entorno de desarrollo con los paquetes instalados y la configuracion necesaria para su funcionamiento esta echa, esperamos en 
**W4-Technologies de Mexico** que este paquete sea de su enetera satisfaccion.

## 📜 Licencia 

Este software está licenciado bajo MIT License. Consulta el archivo [LICENSE.md](https://github.com/Sagat1200/W4LaravelKit/blob/main/LICENSE.md) para más información.

## 🤝 Créditos
Desarrollado con ❤️ por:

👤 Francisco J. Morales

🔗 GitHub: [FranciscoJ.Morales](https://github.com/Sagat1200)

🔗 Web: [w4.software](https://w4.software)