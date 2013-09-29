define(["jquery", "store", "require.store", "underscore", "configuration" , "epiceditor", "data", "shop"], function($, Store, res, u, conf, EpicEditor, data, shop) {

  console.log("DATA IS:", data);
  console.log("SHOP IS:", shop);

	var epicEditor = new EpicEditor({
    file: {
      name: 'epiceditor18',
      defaultContent: "Title \
        \n=================\
        \n\
        \n... Text ... \
        \n\
        \n- List Element 1 \
        \n- List Element 2 \
        \n- List Element 3 \
        \n- List Element 4 \
        \n- List Element 5 \
        \n- [Link 1](http://www.google.com/) \
        \n- [Link 2](http://www.google.com/) \
        \n- [Link 3](http://www.google.com/) \
        \n- [Link 4](http://www.google.com/) \
        \n- [Link 5](http://www.google.com/) \
      ",
      autoSave: 100
    },
    theme: {
      base: '/../assets/apps/epiceditor/themes/base/epiceditor.css',
      preview: '/../assets/apps/epiceditor/themes/preview/import.css',
      editor: '/../assets/apps/epiceditor/themes/editor/epic-dark.css'
    },
    autogrow: true          
  }).load();
	console.log("EpicEditor", epicEditor);
  _.when(documentStore.list()).done(function(data){
    console.log((data));
  });        
});
