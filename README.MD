#installation


*Пакет требует установленных пакетов*
     "laravelrus/sleepingowl": "4.*@dev",
     
**также необходимо выполнить команду 
php artisan make:auth перед установкой
     
     #Установка пакета
     	 Добавляем в composer.json require секция "gennadiy-bilyk/roles":"*@dev"
     	 composer update
          
          Добавляем сервис провайдеры в config/app
     	       GennadiyBilyk\Roles\RolesProvider::class,
     		  
     	 Выполняем 
     	 
     	  php artisan vendor:publish --provider="GennadiyBilyk\Roles\RolesProvider" --force
     	  
     	  Заюзаем трэйт  App\Models\Permission\HasRoles в модель User
     	  
     	  Добавим в модель User методы
     	    /**
               * @return bool
               */
              public function isSuperAdmin()
              {
                  return $this->hasRole('admin');
              }
              
   
     	  
     	  Добавим вызов сидера в database/DatabaseSeeder.php
     	  $this->call(PermissionsRolesSeeder::class);
     	  
     	  Выполним
     	  php artisan migrate
     	  php artisan db:seed --class=PermissionsRolesSeeder
     	  
     	  В файл app\Http\Kernel.php в свойство $routeMiddleware добавим
     	  'admin' => \App\Http\Middleware\AdminAuthenticate::class,
     	  
     	  В файле конфигурации админки config\sleeping_owl.php
     	  поменяем middleware на 
     	  'middleware' => ['web','admin'],
     	  
     	  
     	  Добавляем модель в app\Providers\AdminSectionsServiceProvider.php свойство $sections
     	    \App\User::class => 'App\Http\Sections\Users',
             \App\Models\Permission\Role::class=>'App\Http\Sections\Roles',
     	  
     	  
     	  Добавим в меню админки
     	         [
                           'title' => 'Permissions',
                           'icon' => 'fa fa-exclamation',
                           'priority' =>'10000',
                           'pages' => [
                   
                               (new Page(\App\Models\Permission\Role::class))
                                   ->setPriority(100),
                               (new Page(\App\User::class))
                                   ->setPriority(100)
                           ]
                       ]
                       
                       