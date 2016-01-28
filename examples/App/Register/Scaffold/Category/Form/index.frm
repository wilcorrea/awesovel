{
  "id": "index",
  "layout": "grid",
  "config": {
    "items": {
      "id": {
        "width": 50,
        "parser": "void"
      }
    }
  },
  "items": {
    "id": {},
    "name": {}
  },
  "actions": {
    "add": {
      "id": "add",
      "action": "add",
      "type": "frontend",
      "position": {
        "top": 0,
        "bottom": 0
      },
      "parameters": [],
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
      "parameters": [
        "id"
      ],
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
      "parameters": [
        "id"
      ],
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
      "parameters": [
        "id"
      ],
      "className": "",
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