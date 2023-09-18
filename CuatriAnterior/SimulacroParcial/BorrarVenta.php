<?php
/*
7- (2 pts.) borrarVenta.php(por DELETE), debe recibir un número de pedido,se borra la venta y la foto se mueve a
la carpeta /BACKUPVENTAS*/
include_once "venta.php";

class BorrarVenta
{
    public static function BorrarVenta()
    {
        try 
        {
            $numeroPedido = $_GET["_numeroPedido"];
            $arrayVentas = Venta::LeeJson();
            $ventaAborrar = NULL;
            if($numeroPedido != NULL)
            {
                foreach ($arrayVentas as $venta) 
                {
                    if ($numeroPedido == $venta->GetNumeroPedido()) 
                    {
                        $ventaAborrar = $venta;
                        break;
                    }
                }
                if ($ventaAborrar != NULL) 
                {
                    $key = array_search($ventaAborrar, $arrayVentas); //busca la key de la venta a borrar
                    unset($arrayVentas[$key]); //borra del array por key
                    Venta::GuardaJson($arrayVentas);
                    echo "Se borro la venta <br/>"; 
                    if (Venta::BorraImagenPorNumero($ventaAborrar)) 
                    {
                        echo "Se pudo borrar la imagen de la venta";
                    } 
                    else
                    {
                        throw new Exception("No se pudo borrar la imagen");
                    }
                }
                else
                {
                    echo "No se encontro la venta";
                }
            }
            else
            {
                echo "Error";
            }
        }
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }
    
}
?>