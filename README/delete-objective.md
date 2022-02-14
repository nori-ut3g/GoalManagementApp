### 権限
User

### エンドポイント
```
DELETE https://goal-management.com/api/objectives/{objective_id}/delete
```


### パラメータ
| 場所     | 随意性                               | 名称                                    | 内容                                                                                                 |
| -------- | ------------------------------------ | --------------------------------------- | ---------------------------------------------------------------------------------------------------- |
| ヘッダー | 必須                                 | `Authorization` または `X-MFOAuthToken` | `` Bearer `アクセストークン`  ``; ここで `` `アクセストークン` `` は [`access_token`](token.md) の値 |
| パス | 必須               | `search_keyword`                        | このキーを元に金融機関名 (漢字もしくは読みがな) で検索する                                           |
| 本文 | 必須               | `search_keyword`                        | このキーを元に金融機関名 (漢字もしくは読みがな) で検索する                                           |

### 応答
```js
{
    created_at: "2022-02-14T15:57:43.000000Z"
    finish_date: null
    id: 36
    note: "fdsd"
    objective_id: 12
    order: 0
    start_date: null
    status: 0
    title: "ds"
    updated_at: "2022-02-14T15:57:49.000000Z"
    user_id: 5
}
```

