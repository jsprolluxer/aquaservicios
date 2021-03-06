<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class ContactsController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
   public function index ()
   {}

   public function Mail(){
	
	if(isset($this->request->data['name'])) {
		
	$destinatario = $this->request->query['name'];
	$asunto = "Solicitud de Información en WEB";
	
	$cuerpo = "
		<html>
			<body style='background:#FFF;' align='center'>
				<head>
				   <title>AquaServicios</title>
				</head>
					<div >
						<div style='color:#767676 ;font-size: 50px;' > AquaServicios </div>
						<br>
						<table  border='1px black' align='center' style='border-collapse:collapse' cellpadding='5'  padding='2'>
							<tr>
								<td colspan='2' align='center'>Se a solicitado informac&iacute;on desde la Web</td>
							</tr>
							<tr>
								<td>Nombre: </td>
								<td>" . $this->request->data['name'] . "</td>
							</tr>
							<tr>
								<td>Email: </td>
								<td>" . $this->request->data['mail']. "</td>
							</tr>
							<tr>
								<td>Telefono: </td>
								<td>" . $this->request->data['phone'] . "</td>
							</tr>
							<tr>
								<td>Mensaje: </td>
								<td>" . $this->request-data['message'] . "</td>
							</tr>
						</table>			
					</div>
				</body>
		</html>
		";							
					
	}
	else
	{
		$cuerpo = "Script PHP no esta recibiendo _POST...";
	}		
	
	//para el envío en formato HTML
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

	//dirección del remitente
	$headers .= "From: Contacto Web<jorgesilva@prollux.com>\r\n";
	mail($destinatario,$asunto,$cuerpo,$headers);
	header('Location: http://www.prollux.com/' );
	echo json_encode("ok");

   }

 
}
