#pip install html2pdf
#pip install wkhtmltopdf




#from wkhtmltopdf import HTMLURLToPDF
#make_pdf = HTMLURLToPDF(
    #url='https://foraydevliveadmin.jasongroup.co.kr/Analytic/view/11926',
    #output_file='11926.pdf',
#)
#make_pdf.render()
from html2pdf import HTMLToPDF

HTML = """
    <!DOCTYPE html>
    <html>
        <body>
        <h1>Hello World</h1>
        </body>
    </html>
"""

h = HTMLToPDF(HTML, self.output_file)