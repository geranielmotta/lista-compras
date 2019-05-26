'use strict';
 
/* Directives */

angular.module('directives',[])

        .directive('restrict', function($localStorage){
	return{
		restrict: 'A',
		prioriry: 100000,
		scope: false,
		link: function(){
			// alert('ergo sum!');
		},
		compile:  function(element, attr, linker){
			var accessDenied = true;
                        
                            var attributes = attr.access.split(" ");
                            for(var i in attributes){
				if($localStorage.access_levels == attributes[i]){
					accessDenied = false;
				}
                            }


                            if(accessDenied){
				element.children().remove();
				element.remove();			
                            }        
                        
                        
                       // });
                        
		

		}
	};
})

      