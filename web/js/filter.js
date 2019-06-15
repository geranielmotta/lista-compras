angular.module('filter',[])

.filter("dateBR", function(){
    return function(input) {
        var o = input.replace(/-/g, "/");
        return Date.parse(o); 
    };
})
.filter('coin', function () {
        return function (amount) {
            var n = amount,
            c = 2,
            d = ",",
            t = ".",
            s = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
            return 'R$ ' + s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        }
})
.filter('tel', function () {
    return function (input) {
      var str = input + '';
      str = str.replace(/\D/g, '');
      if (str.length === 11) {
        str = str.replace(/^(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
      } else {
        str = str.replace(/^(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
      }
      return str;
    };
  });