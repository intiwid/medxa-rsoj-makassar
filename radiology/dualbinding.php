<!-- <style type="text/css">
  .container {
  max-width: 800px;
  padding: 25px;
  margin: auto;
}

.live-search-list {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  padding: 1em;
  background-color: #369;
  -webkit-border-radius: 15px;
  -moz-border-radius: 15px;
  border-radius: 15px;
  font-family: 'Lato', sans-serif;
  color: #fff;
  outline: none;
}

.live-search-box {
  width: 100%;
  display: block;
  padding: 1em;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  border: 1px solid #3498db;
  -webkit-border-radius: 15px;
  -moz-border-radius: 15px;
  border-radius: 15px;
  outline: none;
}

.live-search-list li {
  display: block;
  text-decoration: none;
  color: fff;
  padding: 10px 20px;
  margin: auto 15px;
}

li {
  border-bottom: 2px solid #3498db;
}

li:last-of-type {
  border: none;
}

li:hover{
  cursor: pointer;
  border-radius: 25px;
  border: none;
  opacity: 1; 
  background: #f3f8f8;
  color: #9e9e9e;
 }

</style>



<head>
  <meta charset="UTF-8">
  <title>Live Search</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container">
    <input type="text" class="live-search-box" placeholder="search here">
    <ul class="live-search-list">
      <a href="#"><li>This</li></a>
      <a href="#"><li>Is</li></a>
      <li>My</li>
      <li>Search</li>
      <li>With</li>
      <li>Black Jack</li>
      <li>and</li>
      <li>Sluts</li>
      <li>BellHard</li>
    </ul>
  </div>
  <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src = "js/main.js"></script>






  <script type="text/javascript">
    jQuery(document).ready(($) => {
  const ENTER = 13;

  $('.live-search-list li').each(function(){
    $(this).attr('data-search-term', $(this).text().toLowerCase());
  });

  $('.live-search-box').on('keyup', function(){
    const searchTerm = $(this).val().toLowerCase();
    $('.live-search-list li').each(function(){
      ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1)
        ? $(this).show()
        : $(this).hide();      
    });
  });

  $('input[class=live-search-box]').keydown(function(e){
    if(e.keyCode == ENTER){
      e.preventDefault();
      e.stopPropagation();
      
      const toAdd = $('input[class=live-search-box]').val();
      if (toAdd) {
        $('<li/>' , {
          'text': toAdd,      
          'data-search-term':  toAdd.toLowerCase(),
        }).appendTo($('ul'));
        $('input[class=live-search-box]').val('');
        console.log('User has entered '+toAdd);        
      }    
    }
  });

  $(document).on('dblclick', 'li', function(){
    $(this).fadeOut('slow',function(){
      $(this).remove();
    });
  });

});
  </script>
</body> -->

<!DOCTYPE html>
<html>
  <body>
    <div ng-app="app" ng-controller="ctrl">
      <button type="button" ng-click="setEditorData()">Set Editor Data</button>
      <ckeditor ng-model="editorData"></ckeditor>
      <textarea>{{ editorData }}</textarea>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.2/angular.min.js"></script>
    
    <script>
      angular
        .module('app', [])
        .controller('ctrl', $scope => {
          $scope.editorData = null;
          $scope.setEditorData = function () {
            $scope.editorData = '<strong>Test</strong>';
          };
        })
        .directive('ckeditor', () => {
          return {
            require: '?ngModel',
            link: function (scope, element, attr, ngModel) {
              if (!ngModel) return;
               ClassicEditor
                .create(element[0])
                .then(editor => {
                  editor.model.document.on('change:data', () => {
                    ngModel.$setViewValue(editor.getData());
                    // Only `$apply()` when there are changes, otherwise it will be an infinite digest cycle
                    if (editor.getData() !== ngModel.$modelValue) {
                      scope.$apply();
                    }
                  });
                  ngModel.$render = () => {
                    editor.setData(ngModel.$modelValue);
                  };
                  scope.$on('$destroy', () => {
                    editor.destroy();
                  });
                });
            }
          };
        });
    </script>
  </body>
</html>