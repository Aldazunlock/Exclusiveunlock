<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;

class ThermalPrintController extends Controller
{
    public function printBooking($id)
    {
        $booking = Booking::with(['customer', 'items'])->findOrFail($id);

        try {
            // Configuración de la impresora (ajusta según tu hardware)
            $connector = new NetworkPrintConnector(
                config('printing.ip'),
                config('printing.port', 9100)
            );

            $printer = new Printer($connector);

            // Encabezado
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("TALLER DE REPARACIONES\n");
            $printer->text("----------------------------\n");
            $printer->text("Recibo #{$booking->id}\n");
            $printer->text("Fecha: " . now()->format('d/m/Y H:i') . "\n\n");

            // Datos del cliente
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("CLIENTE: {$booking->customer->name}\n");
            $printer->text("TEL: {$booking->customer->phone}\n");
            $printer->text("F. Recepción: {$booking->receive_date->format('d/m/Y')}\n");
            $printer->text("F. Entrega: {$booking->delivery_date->format('d/m/Y')}\n");
            $printer->text("Técnico: {$booking->technician}\n");
            $printer->text("----------------------------\n");

            // Dispositivos
            foreach ($booking->items as $item) {
                $printer->text("MARCA: {$item->brand->title}\n");
                $printer->text("MODELO: {$item->brandModel->title}\n");
                $printer->text("IMEI/SN: {$item->device_number}\n");
                $printer->text("FALLA: {$item->fault_discription}\n");
                $printer->text("MONTO: $" . number_format($item->amount, 2) . "\n");
                $printer->text("----------------------------\n");
            }

            // Pie de página
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("\nGRACIAS POR SU PREFERENCIA\n");
            $printer->text(config('app.name') . "\n");

            $printer->cut();
            $printer->close();

            return back()->with('success', 'Recibo enviado a la impresora térmica');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al imprimir: ' . $e->getMessage());
        }
    }
}