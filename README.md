## About Posyandu System for Tata Surya Housing Malang

The **Posyandu System for Tata Surya Housing Malang** is a web-based application designed to simplify the management and reporting of Posyandu activities in the Tata Surya Housing area, Malang. This system allows health officers and the community to manage health data for pregnant women, children, and other services related to family and community health.

The main features of this system include:
- **Posyandu Management**: Management of Posyandu event schedules, visit data, and child growth analysis.
- **Family Health Services**: Data on maternal health checkups, child immunizations, and more.
- **User and Role Management**: Managing user data in the system with appropriate roles and permissions.

## Main Features

- **Fast and Simple Routing**: This system uses Laravel's routing, which is easy to use and fast in managing application routes.
- **Health Data Management**: Allows the management of medicine data, Posyandu visit schedules, and the health status of children and mothers.
- **Role-based Access Control**: Access to the system can be controlled based on user roles (e.g., Posyandu officers, admins, etc.).

## Installation

### Prerequisites

Ensure that you have installed [Composer](https://getcomposer.org/), [PHP](https://www.php.net/), and [Laravel](https://laravel.com/docs) on your computer.

### Installation Steps

1. Clone this repository to your local machine:
    ```bash
    git clone https://github.com/Daffaaq/sistem-posyandu-tata-surya-malang
    ```

2. Navigate to the project directory:
    ```bash
    cd your-folder-name
    ```

3. Install the dependencies using Composer:
    ```bash
    composer install
    ```

4. Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```

5. Set the application key:
    ```bash
    php artisan key:generate
    ```

6. Run database migrations and seeders (optional to populate with dummy data):
    ```bash
    php artisan migrate --seed
    ```

7. Start the application:
    ```bash
    php artisan serve
    ```

You can access the application at [http://localhost:8000](http://localhost:8000).

## Contributing

Thank you for considering contributing to this project! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Support

If you have any questions or issues with this project, please open an [issue on GitHub](https://github.com/Daffaaq/sistem-posyandu-tata-surya-malang/issues).

## Security

If you discover a security issue in this system, please send an email to [daffaaqila48@gmail.com](daffaaqila48@gmail.com).

## License

This system is open-source and licensed under the [MIT License](https://opensource.org/licenses/MIT).

This system uses the **SB Admin 2** template, which is licensed under the MIT License.
Copyright (c) 2013-2021 Start Bootstrap LLC. For more information, please visit:
https://github.com/startbootstrap/sb-admin

This project (Posyandu System for Tata Surya Housing Malang) is also licensed under the [MIT License](https://opensource.org/licenses/MIT).

The software is provided "as is", without warranty of any kind, express or implied, including but not limited to the warranties of merchantability, fitness for a particular purpose, and noninfringement. In no event shall the authors or copyright holders be liable for any claim, damages, or other liability, whether in an action of contract, tort, or otherwise, arising from, out of, or in connection with the software or the use or other dealings in the software.


