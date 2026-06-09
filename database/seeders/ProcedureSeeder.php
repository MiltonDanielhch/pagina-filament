<?php

namespace Database\Seeders;

use App\Models\Procedure;
use App\Models\Secretariat;
use Illuminate\Database\Seeder;

class ProcedureSeeder extends Seeder
{
    public function run(): void
    {
        $secretariats = Secretariat::pluck('id', 'acronym');

        $items = [
            [
                'code' => 'GAD-BENI-T-001',
                'name' => 'Certificación de No Propiedad',
                'category' => 'catastro',
                'description' => "1. Presentarse en la oficina de Catastro con cédula de identidad vigente.\n2. Solicitar el formulario de certificación.\n3. Completar el formulario con datos personales.\n4. Esperar la verificación en el sistema catastral.\n5. Retirar la certificación en el plazo establecido.",
                'requirements' => "- Cédula de identidad vigente y original\n- Fotocopia de cédula\n- Comprobante de pago de tasa administrativa",
                'cost' => 20.00,
                'processing_time_days' => 5,
                'schedule' => 'Lun-Vie 08:00-16:00',
                'is_online' => false,
                'is_featured' => true,
                'sort_order' => 1,
                'secretariat' => 'SDH',
            ],
            [
                'code' => 'GAD-BENI-T-002',
                'name' => 'Pago de Impuestos Inmobiliarios',
                'category' => 'impuestos',
                'description' => "1. Acudir a la plataforma SISCOR o las oficinas de Hacienda.\n2. Presentar el número de código catastral.\n3. Verificar el monto a pagar.\n4. Realizar el pago en entidades financieras autorizadas.\n5. Obtener el comprobante de pago.",
                'requirements' => "- Código catastral del inmueble\n- Cédula de identidad del propietario\n- Comprobante de pago anterior (si aplica)",
                'cost' => null,
                'processing_time_days' => 1,
                'schedule' => 'Lun-Vie 08:00-16:00',
                'is_online' => true,
                'online_url' => 'https://siscor.beni.gob.bo',
                'is_featured' => true,
                'sort_order' => 2,
                'secretariat' => 'SDH',
            ],
            [
                'code' => 'GAD-BENI-T-003',
                'name' => 'Registro de Marca Ganadera',
                'category' => 'ganaderia',
                'description' => "1. Presentar solicitud en la Secretaría de Desarrollo Productivo.\n2. Adjuntar documentos del ganado y propietario.\n3. Inspección de campo por técnicos.\n4. Asignación de código de marca.\n5. Entrega del certificado de marca.",
                'requirements' => "- Cédula de identidad del propietario\n- Documento de propiedad del ganado\n- Croquis de ubicación del establecimiento\n- Pago de tasa registral",
                'cost' => 150.00,
                'processing_time_days' => 15,
                'schedule' => 'Lun-Vie 08:00-16:00',
                'is_online' => false,
                'is_featured' => true,
                'sort_order' => 3,
                'secretariat' => 'SDDP',
            ],
            [
                'code' => 'GAD-BENI-T-004',
                'name' => 'Solicitud de Constancia de Residencia',
                'category' => 'otro',
                'description' => "1. Acudir a la oficina de atención al ciudadano.\n2. Presentar cédula de identidad.\n3. Llenar formulario de solicitud.\n4. Verificación de datos en el padrón.\n5. Entrega de constancia.",
                'requirements' => "- Cédula de identidad vigente\n- Comprobante de domicilio (servicio básico)\n- Pago de tasa",
                'cost' => 10.00,
                'processing_time_days' => 3,
                'schedule' => 'Lun-Vie 08:00-16:00',
                'is_online' => false,
                'is_featured' => false,
                'sort_order' => 4,
                'secretariat' => 'SG',
            ],
            [
                'code' => 'GAD-BENI-T-005',
                'name' => 'Permiso de Construcción',
                'category' => 'infraestructura',
                'description' => "1. Presentar planos arquitectónicos firmados por profesional colegiado.\n2. Adjuntar título de propiedad del terreno.\n3. Pago de tasas municipales y departamentales.\n4. Revisión técnica por la Secretaría de Obras Públicas.\n5. Emisión del permiso.",
                'requirements' => "- Plano arquitectónico (3 copias)\n- Título de propiedad del terreno\n- Cédula de identidad del propietario\n- Comprobante de pago de tasas\n- Estudio de suelos (si corresponde)",
                'cost' => 500.00,
                'processing_time_days' => 30,
                'schedule' => 'Lun-Vie 08:00-16:00',
                'is_online' => false,
                'is_featured' => true,
                'sort_order' => 5,
                'secretariat' => 'SDOPI',
            ],
            [
                'code' => 'GAD-BENI-T-006',
                'name' => 'Solicitud de Audiencia con el Gobernador',
                'category' => 'otro',
                'description' => "1. Llenar formulario en línea o en oficinas.\n2. Indicar motivo de la audiencia.\n3. Esperar confirmación de fecha y hora.\n4. Asistir puntualmente a la audiencia.",
                'requirements' => "- Cédula de identidad\n- Documentación de respaldo (si aplica)\n- Número de contacto actualizado",
                'cost' => null,
                'processing_time_days' => 7,
                'schedule' => 'Lun-Vie 08:00-16:00',
                'is_online' => true,
                'online_url' => 'https://siscor.beni.gob.bo/audiencias',
                'is_featured' => true,
                'sort_order' => 6,
                'secretariat' => 'SG',
            ],
            [
                'code' => 'GAD-BENI-T-007',
                'name' => 'Solicitud de Información Pública',
                'category' => 'otro',
                'description' => "1. Presentar solicitud escrita o por medios electrónicos.\n2. Indicar claramente la información requerida.\n3. Esperar respuesta en el plazo legal (10 días hábiles).\n4. Retiro de la información o respuesta fundamentada.",
                'requirements' => "- Cédula de identidad del solicitante\n- Domicilio o correo electrónico para notificaciones\n- Descripción clara de la información solicitada",
                'cost' => null,
                'processing_time_days' => 10,
                'schedule' => 'Lun-Vie 08:00-16:00',
                'is_online' => true,
                'online_url' => 'https://siscor.beni.gob.bo/informacion-publica',
                'is_featured' => true,
                'sort_order' => 7,
                'secretariat' => 'SDJT',
            ],
            [
                'code' => 'GAD-BENI-T-008',
                'name' => 'Inscripción a Programas Sociales',
                'category' => 'salud',
                'description' => "1. Acudir al centro de salud más cercano.\n2. Presentar documentación personal y familiar.\n3. Evaluación socioeconómica.\n4. Inscripción en el programa.\n5. Seguimiento periódico.",
                'requirements' => "- Cédula de identidad de todos los miembros del grupo familiar\n- Certificado de nacimiento de hijos menores\n- Comprobante de ingresos (si tiene)\n- Factura de servicio básico",
                'cost' => null,
                'processing_time_days' => 14,
                'schedule' => 'Lun-Vie 08:00-16:00',
                'is_online' => false,
                'is_featured' => false,
                'sort_order' => 8,
                'secretariat' => 'SDS',
            ],
        ];

        foreach ($items as $data) {
            $secretariatAcronym = $data['secretariat'];
            unset($data['secretariat']);

            $secretariatId = $secretariats[$secretariatAcronym] ?? null;

            Procedure::updateOrCreate(
                ['code' => $data['code']],
                $data + [
                    'slug' => \Illuminate\Support\Str::slug($data['name']),
                    'responsible_secretariat_id' => $secretariatId,
                    'status' => 'activo',
                ]
            );
        }
    }
}
