<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <x-application-logo class="block h-12 w-auto" />

    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Bienvenido a SGC - Sistema de Gestión de Consentimientos
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        Nuestra aplicación está diseñada para gestionar los consentimientos de los usuarios registrados, permitiéndoles tener 
        un control sobre su información. A través de la plataforma, cada usuario puede seleccionar qué permisos y 
        consentimientos desea otorgar o revocar, asegurando transparencia y control sobre sus datos personales. Además, ofrece
        la posibilidad de gestionar y actualizar su información en cualquier momento, garantizando una experiencia segura y 
        conforme a las normativas de protección de datos.
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
            <h2 class="ms-3 text-xl font-semibold text-gray-900">
                <a href="{{ route('politica-privacidad') }}">Política de Privacidad</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
        Aquí, los usuarios pueden leer en detalle cómo se recopilan, utilizan y protegen sus datos. También pueden revisar 
        cualquier actualización en nuestras políticas y entender mejor sus derechos y opciones.
        </p>

        <p class="mt-4 text-sm">
            <a href="{{ route('politica-privacidad') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Ir a Política de Privacidad

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>

    <div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 10V7a6 6 0 1112 0v3M5 10h14a1 1 0 011 1v8a1 1 0 01-1 1H5a1 1 0 01-1-1v-8a1 1 0 011-1z"/>
            </svg>
            <h2 class="ms-3 text-xl font-semibold text-gray-900">
                <a href="{{ route('permisos') }}">Permisos</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            En esta sección, los usuarios pueden otorgar o revocar permisos para acceder a sus datos personales todo en 
            cumplimiento de la Ley Orgánica de Protección de Datos Personales de Ecuador.
        </p>

        <p class="mt-4 text-sm">
            <a href="{{ route('permisos') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Ir a Permisos

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>

    <div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2M12 3a9 9 0 100 18 9 9 0 000-18z"/>
            </svg>
            <h2 class="ms-3 text-xl font-semibold text-gray-900">
                <a href="{{ route('historial') }}">Historial de Acceso</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
        En esta sección, los usuarios pueden ver un registro de las veces que han accedido a la aplicación, incluyendo fechas, 
        dispositivos y ubicaciones, lo que les permite monitorear cualquier actividad inusual en su cuenta.
        </p>

        <p class="mt-4 text-sm">
            <a href="{{ route('historial') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Ir a Historial de Acceso

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>

    <div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c3.87 0 7 3.13 7 7v5h1a1 1 0 010 2H4a1 1 0 010-2h1v-5c0-3.87 3.13-7 7-7zM10 19a2 2 0 004 0"/>
            </svg>
            <h2 class="ms-3 text-xl font-semibold text-gray-900">
            <a href="{{ route('notificaciones') }}">Notificaciones</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Aquí, los usuarios pueden recibir notificaciones sobre actualizaciones, cambios en las políticas de privacidad, y otras 
            informaciones relevantes.
        </p>

        <p class="mt-4 text-sm">
            <a href="{{ route('notificaciones') }}" class="inline-flex items-center font-semibold text-indigo-700">
                Ir a Notificaciones

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 size-5 fill-indigo-500">
                    <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </p>
    </div>
</div>
