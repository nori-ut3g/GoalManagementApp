### 権限


### エンドポイント
```
GET https://goal-management.com/api/sharedObjective/{shared_objective_id}
```


### パラメータ
| 場所  | 名称     | 内容 |
|-----|--------|--|
| 本文  | `name` | UserName　Max:20 |
| 本文  | `email` | UserName　unique |
| 本文  | `password` | UserName　Min:8 |
### 応答
```js
{
    {
        created_at: "2022-02-14T15:53:54.000000Z"
        due_date: "2022-02-18"
        finish_date: null
        id: 12
        start_date: "2022-02-14 00:00:00"
        status: 0
        title: "dddd"
        updated_at: "2022-02-14T15:53:54.000000Z"
        user_id: 5        
    }
}
```

