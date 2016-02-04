{
  "id": "show",
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
            "readonly": true
          }
        }
      ]
    }
  ],
  "actions": {
    "index": {
      "id": "index",
      "type": "frontend",
      "action": "index",
      "position": {
        "top": 0,
        "bottom": 0
      },
      "className": "",
      "classIcon": ""
    }
  }
}