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
  "actions": [
    {
      "id": "create",
      "action": "create",
      "type": "frontend",
      "position": [
        "top",
        "bottom"
      ],
      "parameters": [],
      "className": "",
      "classIcon": "glyphicon glyphicon-plus"
    },
    {
      "id": "show",
      "action": "show",
      "type": "frontend",
      "position": [
        "middle"
      ],
      "conditions": [],
      "parameters": [
        "id"
      ],
      "className": "",
      "classIcon": "glyphicon glyphicon-search"
    },
    {
      "id": "edit",
      "action": "edit",
      "type": "frontend",
      "position": [
        "middle"
      ],
      "conditions": [],
      "parameters": [
        "id"
      ],
      "className": "",
      "classIcon": "glyphicon glyphicon-edit"
    },
    {
      "id": "remove",
      "action": "remove",
      "type": "frontend",
      "position": [
        "middle"
      ],
      "conditions": [],
      "parameters": [
        "id"
      ],
      "className": "",
      "classIcon": "glyphicon glyphicon-trash"
    }
  ],
  "events": [
    {
      "before": {
        "module": "",
        "entity": "",
        "operation": "read",
        "parameters": ""
      },
      "after":""
    }
  ]
}