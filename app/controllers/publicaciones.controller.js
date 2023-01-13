const mongoose = require("mongoose");
const Publicacion = mongoose.model("Publicacion");


exports.crearPublicacion = async (req, res) => {
    const {
        estado_publicacion,
        tipo_publicacion,
        producto_servicio,
        titulo_publicacion,
        descripcion_publicacion,
        categoria,
        subcategoria,
        cantidad,
        fecha_inicio_publicacion,
        fecha_fin_publicacion,
        costo,
        unidad_medida,
        usuario_creador,
        imagen1,
        metodo_envio,
        costo_envio,
        metodo_pago,
        condicion,
        zona_entrega_habilitadas
    } = req.body;

    const publicacion = new Publicacion({
        estado_publicacion,
        tipo_publicacion,
        producto_servicio,
        titulo_publicacion,
        descripcion_publicacion,
        categoria,
        subcategoria,
        cantidad,
        fecha_inicio_publicacion,
        fecha_fin_publicacion,
        costo,
        unidad_medida,
        usuario_creador,
        imagen1,
        metodo_envio,
        costo_envio,
        metodo_pago,
        condicion,
        zona_entrega_habilitadas
    });
    try {
        await publicacion.save();
        return res.status(200).send({message: "Publicacion creada exitosamente"});
    } catch (err) {
        return res.status(500).send({error: err.message});
    }
}



