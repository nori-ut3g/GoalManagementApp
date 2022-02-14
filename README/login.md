### 権限
User

### エンドポイント
```
POST https://goal-management.com/api/login
```


### パラメータ
| 場所  | 名称     | 内容 |
|-----|--------|--|
| 本文  | `email` | UserName　unique |
| 本文  | `password` | UserName　Min:8 |

### 応答

### 応答
| 名称     | 内容 |
|--------|--|
| `message` | ログインしました |

```js
{
    message:'ログインしました'
}
```

