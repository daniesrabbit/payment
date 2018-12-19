
		$(document).pjax('a', '#index', {fragment:'#index', timeout:5000});
		$(document).on('pjax:start', function() { NProgress.start(); });
		$(document).on('pjax:end',   function() { NProgress.done();  });
		
		NProgress.configure({ trickle: false });
		NProgress.configure({ ease: 'ease', speed: 500 });
		NProgress.configure({ showSpinner: false });
		
		POWERMODE.colorful = true; // make power mode colorful
		POWERMODE.shake = false; // turn off shake
		document.body.addEventListener('input', POWERMODE);
		
			function validation()
			{
				NProgress.start();
				var name = document.getElementById("username").value;
				var pwd = document.getElementById("password").value;
				var postStr = "username="+name+"&password="+pwd;
				ajax("ajax.php",postStr,function(result){
					document.getElementById("info").innerHTML=result;
					});
			}
			
			
			
        function shopbuy()
			{
				NProgress.start();
				var id = document.getElementById("shopid").value;
				var name = document.getElementById("shopname").value;
				var postStr = "shopid="+id+"&shopname="+name;
				ajax("ajax.php",postStr,function(result){
					document.getElementById("info").innerHTML=result;
					});
			}
         
            function register()
			{
				NProgress.start();
				var name = document.getElementById("regname").value;
				var pwd = document.getElementById("regpass").value;
				var postStr = "regname="+name+"&regpass="+pwd;
				ajax("ajax.php",postStr,function(result){
					document.getElementById("info").innerHTML=result;
					});
			}
			
			
			function renew()
			{
				NProgress.start();
				var id = document.getElementById("aliyunid").value;
				var postStr = "serverid="+id+"&renew=true";
				ajax("ajax.php",postStr,function(result){
					document.getElementById("info").innerHTML=result;
					});
			}
			
			function logout()
			{
				NProgress.start();
				var name = "logout"
				var postStr = "logout="+name;
				ajax("ajax.php",postStr,function(result){
					document.getElementById("info").innerHTML=result;
					});
			}
			
			function eeditor()
			{
				NProgress.start();
				var cnids = document.getElementById("cnid").value;
				var hkids = document.getElementById("hkid").value;
				var cnins = document.getElementById("cnin").value;
				var hkins = document.getElementById("hkin").value;
				var cnips = document.getElementById("cnip").value;
				var hkips = document.getElementById("hkip").value;
				var places = document.getElementById("place").value;
				var serverids = document.getElementById("serverid").value;
				var postStr = "cnid="+cnids+"&hkid="+hkids+"&cnip="+cnips+"&hkip="+hkips+"&cnin="+cnins+"&hkin="+hkins+"&place="+places+"&serverid="+serverids;
				ajax("adminajax.php",postStr,function(result){
					document.getElementById("info").innerHTML=result;
					});
			}
			
			
			function aliyun(operate,id)
			{
				NProgress.start();
				var postStr = "aliyunid="+id+"&operate="+operate;
				ajax("aliyunajax.php",postStr,function(result){
					document.getElementById("info").innerHTML=result;
					});
			}
			
			
			function ajax(url,postStr,onsuccess)
			{
				var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				xmlhttp.open("POST", url, true); 
				xmlhttp.onreadystatechange = function ()
				{
					if (xmlhttp.readyState == 4) 
					{
						if (xmlhttp.status == 200)
						{
							onsuccess(xmlhttp.responseText);
							NProgress.done();
							if (xmlhttp.responseText.indexOf( "成功" ) > 0 )
							{
							window.setTimeout("window.location='index.php'",2000);
							}	
							
							}
						else
						{
							alert("AJAX服务器返回错误！");
						}
					}
				}
				xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				xmlhttp.send(postStr);
			}
			NProgress.done();