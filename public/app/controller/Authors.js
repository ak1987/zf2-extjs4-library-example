Ext.define('LibraryApp.controller.Authors', {
  extend: 'Ext.app.Controller',

  views: ['AuthorList', 'Author'],
  stores: ['AuthorStore'],
  models: ['Author'],
  init: function() {
    this.control({
      'viewport > authorlist': {
        itemdblclick: this.editAuthor
      },
      // add new author button
      'authorlist button[action=new]': {
        click: this.newAuthor
      },
      'authorwindow button[action=new]': {
        click: this.createAuthor
      },
      'authorwindow button[action=save]': {
        click: this.updateAuthor
      },
      'authorwindow button[action=delete]': {
        click: this.deleteAuthor
      },
      'authorwindow button[action=clear]': {
        click: this.clearForm
      }
    });
  },
  // update
  updateAuthor: function(button) {
    var win    = button.up('window'),
      form   = win.down('form'),
      values = form.getValues(),
      id = form.getRecord().get('id');
    values.id=id;
    Ext.Ajax.request({
      url: 'app/data/update.php',
      params: values,
      success: function(response){
        var data=Ext.decode(response.responseText);
        if(data.success){
          var store = Ext.widget('authorlist').getStore();
          store.load();
          Ext.Msg.alert('Updating',data.message);
        }
        else{
          Ext.Msg.alert('Updating','Failed to update record');
        }
      }
    });
  },
  // create
  createAuthor: function(button) {
    var win    = button.up('window'),
      form   = win.down('form'),
      values = form.getValues();
    Ext.Ajax.request({
      url: 'app/data/create.php',
      params: values,
      success: function(response, options){
        var data=Ext.decode(response.responseText);
        if(data.success){
          Ext.Msg.alert('Создание',data.message);
          var store = Ext.widget('authorlist').getStore();
          store.load();
        }
        else{
          Ext.Msg.alert('Создание','Не удалось добавить книгу в библиотеку');
        }
      }
    });
  },
  // delete
  deleteAuthor: function(button) {
    var win    = button.up('window'),
      form   = win.down('form'),
      id = form.getRecord().get('id');
    Ext.Ajax.request({
      url: 'app/data/delete.php',
      params: {id:id},
      success: function(response){
        var data=Ext.decode(response.responseText);
        if(data.success){
          Ext.Msg.alert('Удаление',data.message);
          var store = Ext.widget('authorlist').getStore();
          var record = store.getById(id);
          store.remove(record);
          form.getForm.reset();
        }
        else{
          Ext.Msg.alert('Удаление','Не удалось удалить книгу из библиотеки');
        }
      }
    });
  },
  clearForm: function(grid, record) {
    var view = Ext.widget('authorwindow');
    view.down('form').getForm().reset();
  },
  newAuthor: function(grid, record) {
    var view = Ext.widget('authorwindow', {config : {isNew : true}});
  },
  editAuthor: function(grid, record) {
    var view = Ext.widget('authorwindow', {config : {isNew : false}});
    view.down('form').loadRecord(record);
  }
});