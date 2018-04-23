(function () {
				var timer;
				var html = document.querySelector('html');
				changeRem();
				function changeRem() {		        	 
					var width = html.getBoundingClientRect().width;
					if(width<768){
						html.style.fontSize = width / 10 + 'px';
					}else{
						html.style.fontSize = '50px';
					}
					
				}
				function Time() {
					clearTimeout(timer);
					timer = setTimeout(function () {
						changeRem();
					},200)
				}		
				window.addEventListener('resize',function () {
					Time();
				})		
				window.addEventListener('pageshow',function (e) {
					if(e.persisted){
						Time();
					}
				})
			})();