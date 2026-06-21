<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = \App\Models\User::first();

        // Si no hay usuario, crear uno temporal
        if (!$user) {
            $user = \App\Models\User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
            ]);
            $user->assignRole('super_admin');
        }

        $categories = \App\Models\Category::all();

        $posts = [
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('slug', 'infraestructura')->first()?->id,
                'title' => 'GOBERNACIÓN DEL BENI FORTALECE COORDINACIÓN CON MONTECRISTO DEL TIQUÍN PARA IMPULSAR EL DESARROLLO PRODUCTIVO Y LA INTEGRACIÓN VIAL',
                'slug' => 'gobernacion-beni-coordinacion-montecristo-tiquin',
                'excerpt' => 'En el marco de la agenda departamental orientada a consolidar un Beni Productivo, Sostenible y Regulado, el gobernador del Beni sostuvo una reunión de coordinación con autoridades y representantes de la comunidad de Montecristo del Tiquín, perteneciente al municipio de Baure y a la provincia Iténez, con el objetivo de atender necesidades prioritarias vinculadas al desarrollo productivo y la integración territorial de esta importante región.',
                'body' => 'Del encuentro participaron el Secretario Departamental de Desarrollo Productivo Rolf Keller, la Secretaria Departamental de Obras Públicas Valeria Duran, la Directora Departamental de Turismo Eliane Moreno, el Director Departamental de Minería Sergio Cholima, el Director Departamental de Límites Jorge Ferrufino, el Subgobernador de la Provincia Iténez, Lidio Cuéllar; el Subalcalde de Montecristo del Tiquín, Santiago Espinoza; y la Secretaria de Relaciones de la Central Campesina de Montecristo del Tiquín, Lidia Tola López, quienes expusieron las principales demandas de las más de 20 comunidades que integran esta zona productora del departamento.
                            Durante la reunión, las autoridades locales solicitaron el apoyo de la Gobernación para el mejoramiento y mantenimiento de los caminos de acceso, fundamentales para el transporte de la producción agrícola y pecuaria de la región. Montecristo del Tiquín es una de las regiones más productivas y estratégicas de la provincia Iténez, donde se generan importantes volúmenes de leche, arroz, maní, urucú, sésamo y otros productos que dinamizan la economía local. Sin embargo, debido a su ubicación alejada de los principales centros urbanos, durante muchos años enfrentó limitaciones en infraestructura caminera y atención general, situación que hoy comienza a ser atendida mediante una gestión que prioriza la presencia del Estado en todo el territorio beniano.
                            Asimismo, las autoridades de la comunidad extendieron una invitación oficial al Gobernador para participar de la 8va Feria Agropecuaria, Ganadera y Cultural Expo Tiquín 2026, que se realizará los días 25 y 26 de julio, evento que reunirá a las 20 comunidades de la región para exponer el potencial productivo, cultural y económico de esta importante zona fronteriza del departamento. La Gobernación del Beni reafirma su compromiso de trabajar de manera coordinada con las organizaciones sociales, autoridades locales y sectores productivos para fortalecer las capacidades de las comunidades, mejorar la conectividad vial y generar condiciones que impulsen el crecimiento económico sostenible en cada lugar del departamento.',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('slug', 'salud')->first()?->id,
                'title' => 'GOBERNACIÓN DEL BENI SE SUMA A LA CAMPAÑA DE DONACIÓN DE SANGRE',
                'slug' => 'gobernacion-beni-campana-donacion-sangre',
                'excerpt' => '“Donar sangre es salvar una vida”, destacó el gobernador del Beni, Jesús Eguez Rivero, durante su participación en la Campaña de Donación de Sangre realizada este martes 16 de junio en la plaza principal José Ballivián de Trinidad.',
                'body' => 'La actividad, organizada por el Banco de Sangre de Referencia Departamental Beni, contó con el respaldo de la Gobernación del Beni, reafirmando el compromiso de las autoridades departamentales con la salud y el bienestar de la población.
                            Acompañaron a la primera autoridad del departamento la Primera Dama del Beni, el Secretario Departamental de Desarrollo Humano, la Subgobernadora de Cercado, Corregidora del Municipio de Trinidad y el Director de Relacionamiento Internacional, quienes resaltaron la importancia de la donación voluntaria y altruista como un acto de solidaridad que contribuye a salvar vidas y fortalecer el sistema de salud.
                            La Gobernación del Beni invita a la población a sumarse a esta noble causa y a convertirse en donantes voluntarios, promoviendo una cultura de solidaridad y esperanza para quienes requieren transfusiones sanguíneas de manera urgente.',
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('slug', 'cultura')->first()?->id,
                'title' => 'GOBERNACIÓN DEL BENI Y ASOCIACIÓN DE DESCENDIENTES BOLIVIANO-JAPONES ARTICULAN ACCIONES PARA IMPULSAR BECAS Y PROYECTOS DE DESARROLLO',
                'slug' => 'gobernacion-beni-asociacion-descendientes-boliviano-japones-becas-proyectos-desarrollo',
                'excerpt' => 'Con el propósito de ampliar las oportunidades de formación y fortalecer iniciativas de desarrollo para la población beniana, el gobernador del Beni, Jesús Éguez Rivero, sostuvo una reunión de coordinación con representantes de la Asociación de Descendientes Boliviano-Japoneses, quienes manifestaron su predisposición de trabajar de manera conjunta con la Gobernación en beneficio del departamento.',
                'body' => 'Durante el encuentro se abordaron temas vinculados al acceso a programas de becas, cooperación internacional y proyectos orientados a las áreas de educación, salud y desarrollo social. En ese marco, los representantes de la asociación solicitaron el apoyo de la Gobernación para culminar el proceso de obtención de su Personería Jurídica, trámite que actualmente se encuentra en etapa de regularización.
                            Explicaron que la documentación legal otorgada en anteriores gestiones fue extraviada, situación que obligó a reiniciar el procedimiento correspondiente. La consolidación de este proceso permitirá fortalecer institucionalmente a la organización y facilitar el acceso a programas de cooperación promovidos por el Gobierno del Japón, generando nuevas oportunidades para el departamento.
                            Por su parte, el gobernador Jesús Éguez comprometió el respaldo de la administración departamental para agilizar las gestiones necesarias y consolidar una agenda de trabajo conjunta. Asimismo, destacó su experiencia como beneficiario de programas de formación en Japón, expresando su agradecimiento por las oportunidades recibidas y reafirmando su compromiso de promover mayores espacios de capacitación, intercambio académico y desarrollo profesional para jóvenes y profesionales benianos.
                            La Gobernación del Beni reafirma de esta manera su compromiso de fortalecer alianzas estratégicas que contribuyan al desarrollo humano, la educación, la salud y el bienestar de toda la población.',
                'status' => 'published',
                'published_at' => now()->subDays(30),
            ],
        ];

        foreach ($posts as $post) {
            \App\Models\Post::create($post);
        }
    }
}
