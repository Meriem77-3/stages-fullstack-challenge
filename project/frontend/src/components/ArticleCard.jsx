import { useState } from 'react';
import CommentList from './CommentList';

function ArticleCard({ article, onDelete }) {
  const [showComments, setShowComments] = useState(false);

  // Format de date localisé
  const formatDate = (dateString) => {
    if (!dateString) return 'N/A';
    
    const date = new Date(dateString);
    
    return date.toLocaleDateString('fr-FR', {
      year: 'numeric',
      month: '2-digit',
      day: '2-digit',
      hour: '2-digit',
      minute: '2-digit',
    });
  };

  return (
    <div className="card" style={{ padding: '1rem', marginBottom: '1rem', border: '1px solid #ddd', borderRadius: '4px' }}>
      <h3>{article.title}</h3>
      <div style={{ color: '#7f8c8d', fontSize: '0.9em', marginBottom: '0.5rem' }}>
        Par {article.author || 'Utilisateur inconnu'} • {formatDate(article.created_at)}
      </div>
      <p style={{ marginBottom: '1rem' }}>{article.content}</p>
      
      <div style={{ display: 'flex', gap: '0.5rem', alignItems: 'center' }}>
        <button 
          onClick={() => setShowComments(!showComments)}
          style={{ fontSize: '0.9em', cursor: 'pointer' }}
        >
          {showComments ? 'Masquer' : 'Afficher'} commentaires ({article.comments_count || 0})
        </button>
        
        {onDelete && (
          <button 
            onClick={() => onDelete(article.id)}
            style={{ 
              backgroundColor: '#e74c3c',
              color: '#fff',
              fontSize: '0.9em',
              cursor: 'pointer',
              border: 'none',
              padding: '0.3rem 0.6rem',
              borderRadius: '3px'
            }}
          >
            Supprimer
          </button>
        )}
      </div>

      {showComments && (
        <div style={{ marginTop: '1rem', borderTop: '1px solid #ecf0f1', paddingTop: '1rem' }}>
          <CommentList articleId={article.id} />
        </div>
      )}
    </div>
  );
}

export default ArticleCard;
