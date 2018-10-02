/*
habila o campo de valor de RIFA apos clicar no check */
document.addEventListener('DOMContentLoaded'
	, function(){
		var checkBox = document.getElementById('check-box-rifa');
		var textRifa = document.getElementById('text-input-rifa');
		var textQtdMin = document.getElementById('text-input-qt_min');
		var textQtdMax = document.getElementById('text-input-qt_max');
		var textLimite = document.getElementById('text-input-limite');
		checkBox.addEventListener('change', function(){
			if (!this.checked) {
				textRifa.setAttribute('disabled', 'disabled');
				textRifa.value = "";
				textQtdMin.removeAttribute('disabled');
				textQtdMax.removeAttribute('disabled');
				textLimite.removeAttribute('disabled');
			} else {
				textRifa.removeAttribute('disabled');
				textQtdMin.setAttribute('disabled', 'disabled');
				textQtdMin.setAttribute('value', '0');
				textQtdMax.setAttribute('disabled','disabled');
				textQtdMax.setAttribute('value','0');
				textLimite.setAttribute('disabled','disabled');
				textLimite.setAttribute('value','0');
			}
		});
	}, false);
//----------------------------------------------------------------------------
//function Data(){
//	var d = new Date()
//	document.write(d.toLocaleString())
//};
//----------------------------------------------------------------------------
// data e hora
function atualizaRelogio(){ 
			var momentoAtual = new Date();
			
			var vhora = momentoAtual.getHours();
			var vminuto = momentoAtual.getMinutes();
			var vsegundo = momentoAtual.getSeconds();
			
			var vdia = momentoAtual.getDate();
			var vmes = momentoAtual.getMonth() + 1;
			var vano = momentoAtual.getFullYear();
			
			if (vdia < 10){ vdia = "0" + vdia;}
			if (vmes < 10){ vmes = "0" + vmes;}
			if (vhora < 10){ vhora = "0" + vhora;}
			if (vminuto < 10){ vminuto = "0" + vminuto;}
			if (vsegundo < 10){ vsegundo = "0" + vsegundo;}
 
			dataFormat = vdia + " / " + vmes + " / " + vano;
			horaFormat = vhora + " : " + vminuto + " : " + vsegundo;
 
			document.getElementById("data").innerHTML = dataFormat;
			document.getElementById("hora").innerHTML = horaFormat;
 
			setTimeout("atualizaRelogio()",1000);
};
//----------------------------------------------------------------------------
