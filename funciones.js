function pru()
{

	var codO =document.frm_resumen_de_materiales_por_obra.cod_obr; 
	var diaIni =document.frm_resumen_de_materiales_por_obra.diaIni;
	var mesIni =document.frm_resumen_de_materiales_por_obra.mesIni;
	var annoIni =document.frm_resumen_de_materiales_por_obra.annoIni;
	var diaFin =document.frm_resumen_de_materiales_por_obra.diaFin;
	var mesFin =document.frm_resumen_de_materiales_por_obra.mesFin;
	var annoFin =document.frm_resumen_de_materiales_por_obra.annoFin;
	var fechaI = new Date(annoIni.value,mesIni.value,diaIni.value,0,0,0);
	var fechaF = new Date(annoFin.value,mesFin.value,diaFin.value,0,0,0);
	if(fechaI.getTime() > fechaF.getTime())
	{
		alert("La fecha inicial no puede ser mayor que la final");
	}

	return false;
}

function prueba()
{
	alert("Entre a prueba");
	return true;
}


function SonLetras(valor)
{
	var letras = "abcdefghijklmnopqrstuvwxyz "; // cuidado con la Alt + 164 q no pincha
	var resp = true;
	for(var i=0;i<valor.length && resp == true;i++)
	{
		resp = false;
		for(var j=0;j<letras.length && resp == false;j++)
	      {
		     if(valor.charAt(i) == letras.charAt(j) || valor.charAt(i) == letras.charAt(j).toUpperCase()) //Si valor en i es una letra tanto minuscula como mayuscula-toUpperCase()
			 {
				 resp = true;
			 }
	      }
	}
	return resp;
}

function SonNumeros(valor)
{
	var numeros = "0123456789"; 
	var resp = true;
	for(var i=0;i<valor.length && resp == true;i++)
	{
		resp = false;
		for(var j=0;j<numeros.length && resp == false;j++)
	      {
		     if(valor.charAt(i) == numeros.charAt(j)) //Si valor en i es una letra tanto minuscula como mayuscula-toUpperCase()
			 {
				 resp = true;
			 }
	      }
	}
	return resp;
}


function SonNumerosYcomas(valor)
{
	var numeros = "0123456789."; 
	var resp = true;
	for(var i=0;i<valor.length && resp == true;i++)
	{
		resp = false;
		for(var j=0;j<numeros.length && resp == false;j++)
	      {
		     if(valor.charAt(i) == numeros.charAt(j)) //Si valor en i es una letra tanto minuscula como mayuscula-toUpperCase()
			 {
				 resp = true;
			 }
	      }
	}
	return resp;
}


function insert_obra()
{
	var resp = false;
	var codObra =document.frm_obra.codObra;
	var descriccion =document.frm_obra.descriccion;
	var tecnico =document.frm_obra.tecnico;
	var ejecutor =document.frm_obra.ejecutor;
	
	if(Esvacio(codObra) || Esvacio(descriccion) || Esvacio(tecnico) || Esvacio(ejecutor))
	{
		alert("Los campos obligatorios (*) no pueden estar vacios");
	}
	else
	{
		if(SonNumeros(codObra.value) == false || codObra.value.length != 6)
	    {
		   alert("Codigo de obra no valido, solo numeros y 6 caracteres");
	    }
	    else
	    {
		    resp = true;
	    }
	}
	return resp;	
}

function transferencia()
{
	var resp = true;
	var cod_prod =document.frm_transferencia.cod_prod;
	if(cod_prod.value == "")
	{
		resp = false;
		alert("Selecione un producto");
	}
	return resp;
}

function insert_transferencia()
{
	var resp = false;
	var nummDocT =document.frm_InserTransferencia.nummDocT;
	var cod_obraSalida =document.frm_InserTransferencia.cod_obraSalida;
	var cantTrans =document.frm_InserTransferencia.cantTrans;
	var cod_obraEntrada =document.frm_InserTransferencia.cod_obraEntrada;
	if(Esvacio(nummDocT) || cod_obraSalida.value == "" || cod_obraEntrada.value == "" || Esvacio(cantTrans))
	{
		alert("Los campos no pueden estar vacios");
	}
	else
	{
		if(SonNumerosYcomas(cantTrans.value) == false)
	    {
			alert("La cantidad a sacar solo pueden ser numeros");
		}
		else
		{
			if(cod_obraSalida.value.split("|")[1].value < cantTrans.value)
	        {
	            alert("La cantidad de producto a sacar es mayor de la que esta en la obra");
	        }
			else
			{
				if(cod_obraSalida.value.split("|")[0] == cod_obraEntrada.value.split("|")[0])
				{
					alert("No puede hacer una transferencia en una misma obra");
				}
				else
				{
					resp = true;
				}	
			}
	    }
	}
	return resp;
}

function insert_producto()
{
	var resp = false;
	var codproducto =document.frm_producto.codproducto;
	var descriccion =document.frm_producto.descriccion;
	var unidadmedida =document.frm_producto.unidadmedida;
	var preciomn =document.frm_producto.preciomn;
	var preciocuc =document.frm_producto.preciocuc;
	
	if(Esvacio(codproducto) || Esvacio(descriccion) || Esvacio(unidadmedida) || Esvacio(preciomn) || Esvacio(preciocuc))
	{
		alert("No puede haber campos vacios");
	}
	else
	{
		if(codproducto.value.indexOf("  ") != -1 || codproducto.value.charAt(0)==" " || 
	    codproducto.value.charAt(codproducto.value.length -1)==" " || codproducto.value.split(" ").length < 1 || SonNumeros(codproducto.value) == false)
	    {
		   alert("Codigo de producto no valido, solo #");
	    }
	    else
	    {
		    if(SonNumerosYcomas(preciomn.value) == false)
		    {
			   alert("El precio de la MN tiene que ser un numero Ej: (50.15)");
		    }
		    else
		    {
			      if(SonNumerosYcomas(preciocuc.value) == false)
			      {
				      alert("El precio del CUC es un numero");
			      }
			      else
			      {
				     resp =true;
			      }
		    }
	    }
	}
	return resp;	
}

function insert_movimiento()
{
	var resp = true;
	var fecha =document.frm_movimiento.fecha;
	var num_doc =document.frm_movimiento.num_doc;
	var cod_obr =document.frm_movimiento.cod_obr;
	var cod_prod =document.frm_movimiento.cod_prod;
	var cantidad =document.frm_movimiento.cantidad;
	var TipoMovimiento =document.frm_movimiento.TipoMovimiento;
	if(Esvacio( num_doc ) || Esvacio( cod_obr ) || Esvacio( cod_prod ) || Esvacio( cantidad ) || Esvacio( TipoMovimiento ) || Esvacio( fecha ))
	{
		alert("Los campos no pueden estar vacios");
		resp = false;
	}
	else
	{
		
		
	}
	return resp;
}




function funcion1()
{
	var resp = true;
	var cod_obr =document.frm_funcion1.cod_obr;
	var cod_prod =document.frm_funcion1.cod_prod;
	if(cod_obr.value == "" || cod_prod.value == "")
	{
		resp = false;
		alert("Selecione una obra y un producto");
	}
	return resp;
}

function Esvacio(valor)
{
	if(valor.value.length == 0 || valor.value.indexOf("  ") != -1 || valor.value.charAt(0)==" " || valor.value.charAt(valor.value.length -1)==" " || valor.value.split(" ").length < 1)
	{
		return true;
	}
	return false;
}

function una_palabra(valor)
{
	if(valor.value.split(" ").length < 1)
	{
		return false;
	}
	return true;
}




