### 権限
なし

### エンドポイント
```
POST https://goal-management.com/api/register
```

### パラメータ
| 場所  | 名称     | 内容 |
|-----|--------|--|
| 本文  | `name` | UserName　Max:20 |
| 本文  | `email` | Email　unique |
| 本文  | `password` | password　Min:8 |

### 応答
| 名称     | 内容 |
|--------|--|
| `message` | ログアウトしました |

### 例
```js
{
    objective:{
        id:1,
        user_id:1,
        start_date:,
        due_date:,
        status:,
        finish_date:,
        update_at:,
        create_at:,
        
    }
}
```

