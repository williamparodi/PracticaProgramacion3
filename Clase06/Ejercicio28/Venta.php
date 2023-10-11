<?php
require_once "Usuario.php";
require_once "Producto.php";

class Venta
{
    public $_id;
    public $_idproducto;
    public $_idUsuario;
    public $_cantidadItems;
    public $_fecha_de_venta;

    public function MostarVenta()
    {
        return "Venta:".
        $this->_id. " "
        .$this->_idproducto." "
        .$this->_idUsuario." " 
        .$this->_cantidadItems." "
        .$this->_fecha_de_venta;
    }

    public function InsertarLaVenta()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into ventas (id_producto, id_Usuario, cantidad,fecha_de_venta)
        values('$this->_idproducto', '$this->_idUsuario', '$this->_cantidadItems', '$this->_fecha_de_venta')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    
    public function InsertarLaVentaParametros()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into ventas (id_producto, id_Usuario, cantidad,fecha_de_venta)
        values(:id_producto, :idUsuario, :cantidadItems, :fecha_de_venta)");
        $consulta->bindValue(':id_producto', $this->_idproducto, PDO::PARAM_INT);
        $consulta->bindValue(':idUsuario', $this->_idUsuario, PDO::PARAM_INT);
        $consulta->bindValue(':cantidadItems', $this->_cantidadItems, PDO::PARAM_INT);
        $consulta->bindValue(':fecha_de_venta' , $this->_fecha_de_venta,PDO::PARAM_STR);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function TraerTodasLasVentas()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, id_producto, id_Usuario, cantidad,fecha_de_venta FROM venta");
        $consulta->execute();
        //return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario1");
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>