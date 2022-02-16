### 権限
なし

### エンドポイント
```
GET https://goal-management.com/api/sharedObjective/:shared_objective_id
```
### パラメータ
| 場所  | 名称     | 内容              |
|-----|--------|-----------------|
| パス  | `shared_objective_id` | 対象のShare用のID（※） |

※shared_objective_idは、[目標をPublicにしたとき](share-objective.md) 発行される

### 応答
| 名称     | 内容      |
|--------|---------|
| `created_at` | 作成日時    |
| `due_date` | 期限      |
| `finish_date` | 終了日時    |
| `id` | ID      |
| `start_date` | 開始日時    |
| `status` | 目標の状況   |
| `title` | タイトル    |
| `updated_at` | 更新日時    |
| `user_id` | ユーザーのID |

### 応答
```js
{
    created_at: "2022-02-14T15:53:54.000000Z"
    due_date: "2022-02-18"
    finish_date: null
    id: 12
    start_date: "2022-02-14 00:00:00"
    status: 0
    title: "title"
    updated_at: "2022-02-14T15:53:54.000000Z"
    user_id: 5
}
```

