Ext.define('LibraryApp.view.Author', {
  extend: 'Ext.window.Window',
  alias: 'widget.authorwindow',

  title: 'Add author',
  layout: 'fit',
  autoShow: true,
  modal: true,

  config: {
    isNew: true // default options for CREATE entity window
  },

  initComponent: function () {
    // separating for create and update entity windows
    this.items = [{
      xtype: 'form',
      items: [{
        xtype: 'textfield',
        name: 'name',
        fieldLabel: 'Name'
      }]
    }];
    this.buttons = [
      {
        text: 'Add',
        action: 'new'
      },
      {
        text: 'Clear',
        action: 'clear'
      }
    ];

    // additional for update
    if(!this.config.isNew) {
      this.title = 'Edit Author';
      this.buttons = [
        {
          text: 'Delete',
          iconCls: 'delete-icon',
          action: 'delete'
        },
        {
          text: 'Clear',
          action: 'clear'
        },
        {
          text: 'Save',
          iconCls: 'save-icon',
          action: 'save'
        }
      ];
    }

    this.callParent(arguments);
  }
});