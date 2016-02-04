{
  "id": "edit",
  "layout": "form",
  "templateOptions": {
    "recover": "read",
    "limit": 1,
    "parameters": [
      "id"
    ]
  },
  "fields": [
    {
      "className": "formly-row",
      "fieldGroup": [
        {
          "key": "id",
          "type": "input-text",
          "className": "col-sm-12",
          "templateOptions": {
            "label": "Label",
            "placeHolder": "PlaceHolder",
            "required": true,
            "readonly": true
          }
        }
      ]
    },
    {
      "className": "formly-row",
      "fieldGroup": [
        {
          "key": "name",
          "type": "input-text",
          "className": "col-sm-12",
          "templateOptions": {
            "label": "Label",
            "placeHolder": "PlaceHolder",
            "required": true
          }
        }
      ]
    }
  ],
  "actions": {
    "update": {
      "id": "update",
      "type": "backend",
      "action": "update",
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