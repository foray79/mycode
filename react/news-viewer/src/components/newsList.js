import React,{useState,useEffect} from 'react';
import Styled from 'styled-components';
import NewsItems from './newsItems';
import axios from 'axios';
import usePromise from '../lib/usePromise';

const NewsListBlock = Styled.div`
  box-sizing: border-box;
  padding-bottom: 3rem;
  width: 768px;
  margin: 0 auto;
  margin-top: 2rem;
  @media screen and (max-width: 768px) {
    width: 100%;
    padding-left: 1rem;
    padding-right: 1rem;
  }
`;

const sampleArticle={
    title:'제목',
    desc :'내용',
    url :'https://google.com',
    urlToImage:'https://via.placeholder.com/160',
};

const NewsList = ({category}) =>{

  const [loading,response,error] = usePromise(()=>{  
      
          const query = category === 'all' ? '': `&category=${category}`;         
          
          return axios.get(`https://newsapi.org/v2/top-headlines?country=kr${query}&apiKey=0a8c4202385d4ec1bb93b7e277b3c51f`);
      
    },[category]);

    if(loading){
      return <NewsListBlock>대기중...</NewsListBlock>;
    }
  if(!response){
    return null;
  }
  if(error){
    return <NewsListBlock>에러발생 !...</NewsListBlock>;
  }
  const {articles} = response.data;
    return (
        <NewsListBlock>
          {articles.map(article=>(
            <NewsItems key={article.url}  article={article} />
          ))}
        </NewsListBlock>
    );
}

export default NewsList;