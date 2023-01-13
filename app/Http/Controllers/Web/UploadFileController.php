<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

use App\Http\Controllers\Web\Uploader\UploadController;

use Intervention\Image\Facades\Image;

use App\Usuario;

class UploadFileController extends UploadController
{
    /**
     * Handles the file upload
     *
     * @param FileReceiver $receiver
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws UploadMissingFileException
     *
     */
    public function upload_foto_perfil(Request $request,FileReceiver $receiver)
    {
        $this->folder_upload = "storage/imagenes/usuarios";

        // compruebe si la carga se realizó correctamente,
        //lance la excepción o devuelva la respuesta que necesita
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }

        // recibe el archivo
        $save = $receiver->receive();

        // verificar si la carga ha finalizado
        //(en el modo de trozos enviará archivos más pequeños)
        if ($save->isFinished()) {
            // guarda el archivo y devuelve cualquier respuesta que necesites

            $respuesta = $this->saveFile($save->getFile());

            $respuesta_array = $respuesta->getData(true);
            $realpath_image = $respuesta_array["path"]."/".$respuesta_array["name"];

            if(isset($respuesta_array["name"]))
            {
                $borrar_archivo = true;
                
                $formato = "";

                if(strlen($respuesta_array["name"]) > 4)
                {
                    $formato = strtolower(substr($respuesta_array["name"],strlen($respuesta_array["name"])-4,4));
                
                    if($formato == ".png" || $formato == ".jpg" || $formato == ".gif")
                    {
                        $borrar_archivo = false;
                    }
                    else
                    {
                        $formato = strtolower(substr($respuesta_array["name"],strlen($respuesta_array["name"])-5,5));
                        
                        if($formato == ".jpeg" || $formato == ".webp")
                        {
                            $borrar_archivo = false;
                        }
                    }
                }
                
                if($borrar_archivo)
                {
                    $dir = dirname(__FILE__);
                    
                    if(file_exists($respuesta_array["path"]."/".$respuesta_array["name"])) {
                        unlink($respuesta_array["path"]."/".$respuesta_array["name"]);
                    }
                }
                else
                {
                    $image = Image::make($realpath_image);

                    $image->resize(500,500,function($c){
                    $c->aspectRatio();
                    });

                    $image->resizeCanvas(500,500, 'center', false, 'ffffff');

                    if($formato == ".webp")
                    {
                        $image->save($realpath_image);
                    }
                    else
                    {
                        $nombre_imagen = substr($respuesta_array["name"],0,(strlen($respuesta_array["name"]) - strlen($formato)));

                        $image->save($respuesta_array["path"]."/".$nombre_imagen.".webp");

                        $dir = dirname(__FILE__);
                    
                        if(file_exists($respuesta_array["path"]."/".$respuesta_array["name"])) {
                            
                            unlink($respuesta_array["path"]."/".$respuesta_array["name"]);
                        }

                        $respuesta_array["name"] = $nombre_imagen.".webp";
                    }
                }
            }

            $save = $request->input("save");
            $id_usuario = (int) $request->input("id_usuario");

            return $respuesta_array;
        }

        // estamos en modo chunk, enviemos el progreso actual
        /** @var AbstractHandler $handler */

        $handler = $save->handler();

        return response()->json([
            "done" => $handler->getPercentageDone()
        ]);
    }

    public function upload_imagen_publicacion(Request $request,FileReceiver $receiver)
    {
        $this->folder_upload = "storage/imagenes/publicaciones";

        // compruebe si la carga se realizó correctamente,
        //lance la excepción o devuelva la respuesta que necesita
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }

        // recibe el archivo
        $save = $receiver->receive();

        // verificar si la carga ha finalizado
        //(en el modo de trozos enviará archivos más pequeños)
        if ($save->isFinished()) {
            // guarda el archivo y devuelve cualquier respuesta que necesites

            $respuesta = $this->saveFile($save->getFile());

            $respuesta_array = $respuesta->getData(true);
            $realpath_image = $respuesta_array["path"]."/".$respuesta_array["name"];

            if(isset($respuesta_array["name"]))
            {
                $borrar_archivo = true;
                
                $formato = "";

                if(strlen($respuesta_array["name"]) > 4)
                {
                    $formato = strtolower(substr($respuesta_array["name"],strlen($respuesta_array["name"])-4,4));
                
                    if($formato == ".png" || $formato == ".jpg" || $formato == ".gif")
                    {
                        $borrar_archivo = false;
                    }
                    else
                    {
                        $formato = strtolower(substr($respuesta_array["name"],strlen($respuesta_array["name"])-5,5));
                        
                        if($formato == ".jpeg" || $formato == ".webp")
                        {
                            $borrar_archivo = false;
                        }
                    }
                }
                
                if($borrar_archivo)
                {
                    $dir = dirname(__FILE__);
                    
                    if(file_exists($respuesta_array["path"]."/".$respuesta_array["name"])) {
                        unlink($respuesta_array["path"]."/".$respuesta_array["name"]);
                    }
                }
                else
                {
                    $image = Image::make($realpath_image);

                    $image->resize(1200,1200,function($c){
                    $c->aspectRatio();
                    });

                    $image->resizeCanvas(1200,1200, 'center', false, 'ffffff');

                    if($formato == ".webp")
                    {
                        $image->save($realpath_image);
                    }
                    else
                    {
                        $nombre_imagen = substr($respuesta_array["name"],0,(strlen($respuesta_array["name"]) - strlen($formato)));

                        $image->save($respuesta_array["path"]."/".$nombre_imagen.".webp");

                        $dir = dirname(__FILE__);
                    
                        if(file_exists($respuesta_array["path"]."/".$respuesta_array["name"])) {
                            
                            unlink($respuesta_array["path"]."/".$respuesta_array["name"]);
                        }

                        $respuesta_array["name"] = $nombre_imagen.".webp";
                    }
                }
            }

            $save = $request->input("save");
            $id_usuario = (int) $request->input("id_usuario");

            return $respuesta_array;
        }

        // estamos en modo chunk, enviemos el progreso actual
        /** @var AbstractHandler $handler */

        $handler = $save->handler();

        return response()->json([
            "done" => $handler->getPercentageDone()
        ]);
    }
}