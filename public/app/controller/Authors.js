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
      'authorwindow button[action=clear]': {
        click: this.clearForm
      },
      'authorwindow button[action=delete]': {
        click: this.deleteAuthor
      }
    });
  },
  // update
  updateAuthor: function(button) {
    var win    = button.up('window'),
      form   = win.down('form'),
      values = form.getValues(),
      id = form.getRecord().get('id');
    Ext.Ajax.request({
      url: '/admin/api/authors/update/' + id + '/',
      params: values,
      success: function(response){
        var data=Ext.decode(response.responseText);
        if(data.success){
          var store = Ext.widget('authorlist').getStore();
          store.load();
          Ext.Msg.alert('Updating', 'Success: record was updated');
        }
        else{
          let errors = '';
          if(data.message.length > 0) {
            data.message.forEach(function(object, index, array){
              errors += object.field.toUpperCase() +': ' + object.text + '\n';
            })
          }
          Ext.Msg.alert('Update', 'Errors: \n' + errors);
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
      url: '/admin/api/authors/create/',
      params: values,
      success: function(response, options){
        var data=Ext.decode(response.responseText);
        if(data.success){
          Ext.Msg.alert('Create', 'Success: record was added');
          var store = Ext.widget('authorlist').getStore();
          store.load();
        } else {
          let errors = '';
          if(data.message.length > 0) {
            data.message.forEach(function(object, index, array){
              errors += object.field.toUpperCase() +': ' + object.text + '\n';
            })
          }
          Ext.Msg.alert('Create','Errors: \n' + errors);
        }
      }
    });
  },
  // delete
  deleteAuthor: function(button) {
    var win = button.up('window'),
      form = win.down('form'),
      id = form.getRecord().get('id');
    Ext.MessageBox.confirm(
      'Confirm', 'Are you sure you want to do this ?', callbackFunction);
    function callbackFunction(btn) {
      if(btn === 'yes') {
        Ext.Ajax.request({
          method : 'POST',
          url: '/admin/api/authors/delete/' + id + '/',
          success: function(response){
            var data=Ext.decode(response.responseText);
            if(data.success){
              Ext.Msg.alert('Delete', 'Success: record was deleted');
              var store = Ext.widget('authorlist').getStore();
              var record = store.getById(id);
              store.remove(record);
              win.close();
            }
            else{
              Ext.Msg.alert('Delete','Failure: deleting record failed');
            }
          }
        });
      }
    }
  },
  clearForm : function(button) {
    var win = button.up('window'),
      form = win.down('form');
    form.getForm().reset()
  },

  newAuthor: function(grid, record) {
    var view = Ext.widget('authorwindow', {config : {isNew : true}});
  },
  editAuthor: function(grid, record) {
    var view = Ext.widget('authorwindow', {config : {isNew : false}});
    view.down('form').loadRecord(record);
  }
});