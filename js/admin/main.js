

var Regex = /^(\s)*(javascript|data|http:|https:)/im;

function sanitizeUrl(url) {
  var sanitizedUrl = url.replace(Regex, '');
//  var sanitizedUrl = dUrl.replace("/\//",'|'); 
  return sanitizedUrl;
}

function updateElement(tag,urls){
        //alert(tag);
                $.ajax(
                         {
                            type: "get",
                            url: urls,
                            success: function(html){                                     
                            $(tag).html(html);
                            }
                          }
                        );
              }
        function clearElement(tag){
        var clean='';
         $(tag).html(clean);
        }
String.prototype.supplant = function (o) {
    return this.replace(/{([^{}]*)}/g,
            function (a, b) {
                var r = o[b];
                return typeof r === 'string' || typeof r === 'number' ? r : a;
            }
    );
};

function loadJSONContent() {
    //var out='';
    //обеспечиваем аяксовое обновление страницы
    //Вот так выглядит верстка блока с информацией о текущем пользователе и новостной лентой:
    //<div id="logindisplay" data-content="/ru/Partials/Render/_Menu_LogOn">это отображается до загрузки</div>
    $('[data-set]').each(function (r) {
        $(this).addClass('fa fa-spinner fa-spin fa-large');
        self = this;
        id = $(this).attr('id');
        console.log(id);
        $.getJSON($(this).attr('data-set'), function (json) {
            template = json.template;
            data = json.rows;

            self.out = '';
            $(data).each(function (a, row) {
                $('#' + id).append(template.supplant(row));

            });

        });

        $(this).removeClass('fa fa-spinner fa-spin fa-large');
        $(this).append(out);
    });
}
        