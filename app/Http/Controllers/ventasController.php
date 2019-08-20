<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;   
require __DIR__ . '/ticket/autoload.php';
//Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
  
    
    use Mike42\Escpos\PrintConnectors\FilePrintConnector;
    use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use App\Venta;
use App\User;
use App\articulo;
use App\detalle_venta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class ventasController extends Controller
{



    
    public function ingresarVenta(Request $request){
        
          $id_userv =  $request->id_user;   
        $num_comprobante =  $request->num_comp;
         $num_comprobante_validar = DB::table('venta')->select('num_comprobante')->where('num_comprobante','=',$num_comprobante)->get();
       $name_user = DB::table('users')->select('name')->where('id','=',$id_userv)->value('name');

         if (count($num_comprobante_validar)<=0){

        $id_cliente = $request->cliente[0]['id'];
        $num_comprobante =  $request->num_comp;
        $total_venta =  $request->total_venta;
        $descuento = $request->descuento;
        $id_user =  $request->id_user;

        $venta = new Venta;
        $venta->id_cliente = $id_cliente;
        $venta->num_comprobante = $num_comprobante;
        $venta->total_venta =$total_venta;
        $venta->descuento = $descuento; 
        $venta->id_user=$id_user;
       $venta->save();
        //return response()->json('se guardo');

  $nombre_impresora = "POS580"; 
 
 
$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
 
/*
	Imprimimos un mensaje. Podemos usar
	el salto de línea o llamar muchas
	veces a $printer->text()

*/
 
# Vamos a alinear al centro lo próximo que imprimamos
$printer->setJustification(Printer::JUSTIFY_CENTER);
try{
	$logo = EscposImage::load("img\pan.png", false);
    $printer->bitImage($logo);
}catch(Exception $e){}


/*	Ahora vamos a imprimir un encabezado*/

 $printer->setJustification(Printer::JUSTIFY_CENTER);  
$printer->text("TUTIPANDEBONO" . "\n");
$printer->text("NIT: 123123" . "\n");
$printer->text("N° factura:".$num_comprobante . "\n");
#La fecha también
$printer->text(date("Y-m-d H:i:s") . "\n");
    $printer->text(' Vendedor:' .$name_user."\n");
   
$printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text("- - - - - - - - - - - - - - - -"."\n");
$printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text("Descripcion         Uds    Total"."\n");
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text("- - - - - - - - - - - - - - - -"."\n");


 function addSpaces($string = '', $valid_string_length = 0) {
    if (strlen($string) < $valid_string_length) {
        $spaces = $valid_string_length - strlen($string);
        for ($index1 = 1; $index1 <= $spaces; $index1++) {
            $string = $string . ' ';
        }
    }

    return $string;
}

 
   try {    
        for ($i=0; $i<count($request->articulos) ; $i++) {  
      $id_venta_= DB::table('venta')->select('id')->where('num_comprobante','=',$num_comprobante)->value('id');
       $nombre_producto = $request->articulos[$i]['datos']['nombre'];
        $id_articulo = $request->articulos[$i]['datos']['id'];
        $cantidad = $request->articulos[$i]['cantidad'];
        $precio_venta = $request->articulos[$i]['datos']['precio_venta'];
            $cantidad_exist = DB::table('articulo')->select('stock')->where('id','=',$id_articulo)->value('stock');
        $detalle_venta = new detalle_venta();
        $detalle_venta->id_venta=$id_venta_;
        $detalle_venta->id_articulo=$id_articulo;
        $detalle_venta->cantidad=$cantidad;
        $detalle_venta->precio_venta=$precio_venta;
          
         $articulo = articulo::find($id_articulo);
         $articulo->stock = $cantidad_exist - $cantidad;
         
        $detalle_venta->save();
         $articulo->save();         
/*

    Y a la derecha para el importe*/
$total_p = $precio_venta * $cantidad;
$texItem = 'cod '.$id_articulo;

   $line = sprintf('%-10.10s %10.0f %9.2f', $texItem, $cantidad,$total_p);
$printer->setJustification(Printer::JUSTIFY_LEFT);  
$printer->text('-'.$nombre_producto."\n");   
$printer->text($line);
$printer->text("\n"); 
   

        }
        $descuento_ = number_format($descuento);
      $total_real  = number_format($total_venta);
      

           $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text("- - - - - - - - - - - - - - - -"."\n");
         $printer->setJustification(Printer::JUSTIFY_RIGHT);
    $printer->text(' descuento: $' . $descuento_. "\n");  
     $printer->setJustification(Printer::JUSTIFY_RIGHT);
    $printer->text(' TOTAL ........$' . $total_real . "\n");
$printer->text(""."\n");
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text("..:Esperamos pronto tu visita:.."."\n");
    $printer->text("....:Gracias por tu compra:....  "."\n");
    $printer->text(""."\n");
    $printer->text(""."\n");
    

/*
	Ahora vamos a imprimir los
	productos
*/
 
/*
	Hacemos que el papel salga. Es como 
	dejar muchos saltos de línea sin escribir nada
*/
$printer->feed();
 
/*
	Cortamos el papel. Si nuestra impresora
	no tiene soporte para ello, no generará
	ningún error
*/
$printer->cut();
 
/*
	Por medio de la impresora mandamos un pulso.
	Esto es útil cuando la tenemos conectada
	por ejemplo a un cajón
*/
$printer->pulse();
 
/*
	Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
*/
$printer->close();
         return response()->json($name_user);
    } catch (Exception $e) {
        $message = "Couldn't print to this printer: " . $e->getMessage() . "\n";
         return response()->json('NO SE PUDO IMPIMIR');

    }}
    
    
}

        public function SetVentas(){
             $data =   DB::table('venta')
            ->join('persona','venta.id_cliente','=','persona.id')
            ->join('tipo_comprobante','venta.id_tipo_comprobante','=','tipo_comprobante.id')
            ->join('users','venta.id_user','=','users.id')
            ->select('tipo_comprobante.Comprobante','persona.nombre','venta.num_comprobante','venta.total_venta','venta.descuento','venta.created_at','users.name')
            ->orderby('venta.id','desc') 
            ->get();
            return response()->json($data);

        }
          public function SetVenta_( Request $request){
              $num_comprob = $request->num_comp;
             $data =   DB::table('venta')
            ->join('persona','venta.id_cliente','=','persona.id')
            ->join('tipo_comprobante','venta.id_tipo_comprobante','=','tipo_comprobante.id')
            ->join('users','venta.id_user','=','users.id')
            ->select('tipo_comprobante.Comprobante','persona.nombre','venta.num_comprobante','venta.total_venta','venta.descuento','venta.created_at','users.name')
            ->where('venta.num_comprobante','LIKE',"%$num_comprob%")
            
            ->orderby('venta.id','desc') 
            ->get();

            if (count($data)<=0) {
                return response()->json(404);
            }
            else {
                 return response()->json($data);
            }
           

        }


        public function setVentaDetalle( Request $request){

          $num_comp = $request->num_comprobante;

           $id = Venta::where('num_comprobante','=',$num_comp)->first();

          $detalle_id_art = detalle_venta::where('id_venta','=',$id->id)->first();
          
          $detalle_vent = DB::table('detalle_venta')
          ->join('articulo','detalle_venta.id_articulo','=','articulo.id')
          ->select('detalle_venta.*','articulo.*')
          ->where('detalle_venta.id_venta','=', $id->id)
          ->get();

          
          $data = detalle_venta::where('id_venta','=', $id->id)->orderby('id','desc')->get();

         
           for ($i=0; $i <  count($data) ; $i++) { 
                 
                  $data[$i]->articulo;
       } 
           return response()->json($data);


        }
}


    
         
