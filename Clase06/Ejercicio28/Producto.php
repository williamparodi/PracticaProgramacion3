<?php
require_once "./db/AccesoDatos.php";

class Producto
{
    public $_id;
    public $_codigoBarras;
    public $_nombre;
    public $_tipo;
    public $_stock;
    public $_precio;

    public function MostarProducto()
    {
        return "Producto:".$this->_codigoBarras. " ".$this->_nombre. " ".$this->_tipo. " "
        .$this->_stock. " ".$this->_precio;
    }

    public function insertarElProducto()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into producto (código_de_barra, nombre, tipo, stock, percio)
        values('$this->_codigoBarras', $this->_nombre', '$this->_tipo', '$this->_stock', '$this->_precio')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function insertarElProductoParametros()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into producto (código_de_barra, nombre, tipo, stock, percio)
        values(:codigoBarras, :nombre, :tipo, :stock, :precio)");
        $consulta->bindValue(':código_de_barra', $this->_codigoBarras, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->_tipo, PDO::PARAM_STR);
        $consulta->bindValue(':stock', $this->_stock, PDO::PARAM_INT);
        $consulta->bindValue(':precio', $this->_precio, PDO::PARAM_STR);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function TraerTodosLosProductos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, código_de_barra as codigoBarras, nombre, tipo, stock, precio FROM producto");
        $consulta->execute();
        //return $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>