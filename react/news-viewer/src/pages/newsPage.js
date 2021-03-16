import React from 'react';
import Categories from '../components/categories';
import NewsList from '../components/newsList';

const NewsPage= ({match}) =>{
   
    const category = match.params.category || 'all';

    return(
        <>
        <Categories category={category} />
        <NewsList category={category} />
        </>
    );
};

export default NewsPage