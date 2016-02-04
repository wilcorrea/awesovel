{
  "id": "index",
  "layout": "grid",
  "templateOptions": {
    "recover": "read",
    "limit": 0,
    "parameters": [
    ],
    "options": {
      "className": "col-sm-2"
    },
    "items": {
      "id": {
        "width": 50,
        "parser": "void",
        "search": true
      },
      "name": {
        "search": true
      }
    }
  },
  "fields": [
    {
      "key": "id",
      "type": "input-text",
      "className": "col-sm-4",
      "templateOptions": {
        "label": "Label",
        "placeHolder": "PlaceHolder"
      }
    },
    {
      "key": "name",
      "type": "input-text",
      "className": "col-sm-6",
      "templateOptions": {
        "label": "Label",
        "placeHolder": "PlaceHolder"
      }
    }
  ],
  "actions": {
    "add": {
      "id": "add",
      "action": "add",
      "type": "frontend",
      "position": {
        "top": 0,
        "bottom": 0
      },
      "className": "",
      "classIcon": "glyphicon glyphicon-plus"
    },
    "show": {
      "id": "show",
      "action": "show",
      "type": "frontend",
      "position": {
        "middle": 0
      },
      "conditions": [],
      "className": "",
      "classIcon": "glyphicon glyphicon-search"
    },
    "edit": {
      "id": "edit",
      "action": "edit",
      "type": "frontend",
      "position": {
        "middle": 1
      },
      "conditions": [],
      "className": "",
      "classIcon": "glyphicon glyphicon-edit"
    },
    "remove": {
      "id": "remove",
      "action": "remove",
      "type": "frontend",
      "position": {
        "middle": 2
      },
      "conditions": [],
      "className": "btn-primary",
      "classIcon": "glyphicon glyphicon-trash"
    }
  },
  "events": [
    {
      "before": {
        "module": "",
        "entity": "",
        "operation": "read",
        "parameters": ""
      },
      "after": ""
    }
  ]
}