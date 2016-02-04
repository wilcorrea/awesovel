{
  "id": "add",
  "layout": "form",
  "templateOptions": {
    "recover": false,
    "parameters": [
    ]
  },
  "fields": [
    {
      "className": "formly-row",
      "fieldGroup": [
        {
          "key": "name",
          "type": "input-text",
          "className": "col-sm-12",
          "templateOptions": {
            "label": "Label",
            "placeHolder": "PlaceHolder"
          }
        }
      ]
    }
  ],
  "actions": {
    "create": {
      "id": "create",
      "type": "backend",
      "action": "create",
      "position": {
        "top": 0,
        "bottom": 0
      },
      "className": "btn-primary",
      "classIcon": ""
    },
    "index": {
      "id": "index",
      "type": "frontend",
      "action": "index",
      "position": {
        "top": 1,
        "bottom": 1
      },
      "className": "",
      "classIcon": ""
    }
  }
}