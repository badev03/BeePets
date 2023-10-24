import React from 'react';
// import ContentLoader from 'react-content-loader';
import styled, { keyframes } from 'styled-components';
const spin = keyframes`
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
`;

const Container = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
`;

const Loader = styled.div`
  border: 10px solid transparent;
  border-top: 10px solid #6AC9EA;
  border-radius: 50%;
  width: 100px;
  height: 100px;
  animation: ${spin} 1s linear infinite;
`;

const LoadingText = styled.div`
  font-size: 28px;
  color: #6AC9EA;
  margin-top: 20px;
`;
const LoadingSkeleton = () => {
   

    return (
        <div>
      
        <Container>
          <Loader />
          <LoadingText>Loading...</LoadingText>
        </Container>
   
    </div>
    );
}

export default LoadingSkeleton;