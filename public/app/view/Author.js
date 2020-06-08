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
    console.log(this.config.isNew);
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
        text: 'Clear',
        scope: this,
        action: 'clear'
      },
      {
        text: 'Add',
        iconCls: 'save-icon',
        action: 'new'
      }
    ];

    // additional for update
    if(!this.config.isNew) {
      this.buttons = [
        {
          text: 'Clear',
          scope: this,
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